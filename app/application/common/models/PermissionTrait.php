<?php
namespace common\models;

use Yii,
    yii\db\Expression,
    yii\helpers\ArrayHelper,
    common\models\Permission,
    yii\data\ActiveDataProvider,
    yii\data\ArrayDataProvider,
    yii\metadata\component\MetaData;


trait PermissionTrait {
    private $permissionDP;
    
    private $rules = []; 
    
    /*
     * @return Object|yii\data\ActiveDataProvider data provided for all permission tables
     */
    public function getAllRules() {
        if($this->permissionDP){
            return $this->permissionDP;
        }else{
            if($this->hasAttribute('groupId')){
                $Parentgroups = $this->getParentGroups($this->groupId);
                return $this->permissionDP = $this->permissiondataprovider($Parentgroups,$userId=$this->Id);
            }else{
                $Parentgroups = $this->getParentGroups();
                return $this->permissionDP = $this->permissiondataprovider($Parentgroups,$userId=$this->Id);
            }
        }
    }
    
    /*
     * @param integer $groupId group Id of User or it will select current group object Primary key
     * @return array of groups.
     */
    private function getParentGroups($groupId = '') {
        $groups = $_dataMap =  [
                    ];
        
        if(!$groupId){
            $groupId = $this->Id;
        }
        
        $_dataMap = ArrayHelper::map($this->find()
                             ->where(['status' => '1'])
                             ->andWhere('Id <='.$groupId)
                             ->all(),'Id','parentId');
        
        
        $groups[] = $key = $groupId;
        
        while($key!=0){
            if(isset($_dataMap[$key]) && $_dataMap[$key]!=0){
                $groups[] = $key = $_dataMap[$key];
            }else{
                $key = 0;
            }
        };
        return $groups;
    }
    
    /*
     * @param array $groups list of groups
     * @param integer $userId user Id of User
     * @return Object|yii\data\ActiveDataProvider data provided for all permission tables
     */
    private function permissiondataprovider($groups,$userId = 0) {
        if($userId){
            return new ActiveDataProvider([
                'query' => Permission::find()
                                ->where(['groupId' =>$groups,'status'=>1])
                                ->orWhere(['userId' =>$userId]),
                'pagination' => [
                                    'pageSize' => -1,   //for no limit
                                ],
            ]);
        }else{
            return new ActiveDataProvider([
                'query' => Permission::find()->where(['groupId' =>$groups,'status'=>1]),
                'pagination' => [
                    'pageSize' => -1,   //for no limit
                ],
            ]);
        }
    }
    
    public function getPermissions(){
        $adp = $this->getAllRules();
        $this->rules = []; 
        $this->rules['*##*##*'] = 0;
        
        foreach($adp->getModels() as $rec){
            $key = $rec->module.'##'.$rec->controller.'##'.$rec->action;
            $this->rules[$key] = $rec->type;            
        }
        return $this->getPermissionList();
    }
    
    private function getPermissionList(){        
        $meta = new MetaData();
        $allModule = $meta->getRouteMap();
        unset($meta);     
        Yii::beginProfile(__CLASS__.__METHOD__);
        $Ar_dataModel = [];
        //\yii::trace('Module Permission:'.__LINE__.'check rules'.print_r($this->rules,true),'app.permissionTrait');
        foreach($allModule as $moduleName=>$controllerMap){
            if($this->checkAccess($moduleName)){                
                foreach($controllerMap as $controllerName=>$actionMap){                    
                    if($this->checkAccess($moduleName,$controllerName)){
                        $map=[];
                        foreach($actionMap as $action){
                            if($this->checkAccess($moduleName,$controllerName,$action)){
                               $map[]=  ucfirst($action);
                            }
                        }
                        if(count($map))
                        $Ar_dataModel[] = [
                                            ucfirst($moduleName),
                                            ucfirst($controllerName),
                                            implode(', ',$map),
                                            ]; 
                    }else{
                        //No Controller Access
                        continue;
                    }
                }
            }else{
                //No module Access then continue
                continue;
            }
        }
        Yii::endProfile(__CLASS__.__METHOD__);
        return new ArrayDataProvider([
                    'allModels'=>$Ar_dataModel,
                    'pagination' => [
                        'pageSize' => -1,   //for no limit
                    ],
                ]);
    }
    
    private function checkAccess($module,$controller='',$actions='') {
        if($module && $controller && $actions){
            return $this->checkActionAccess($module,$controller,$actions);
        }else if($module && $controller){
            return $this->checkControllerAccess($module,$controller);
        }else{
            return $this->checkModuleAccess($module);
        }
        return false;
    }
    
    private function checkActionAccess($module,$controller,$actions) {        
        $permission = false;
        if(isset($this->rules['*##*##*']) ||
                isset($this->rules['*##'.$controller.'##*']) ||
                isset($this->rules[$module.'##'.$controller.'##*']) ||
                isset($this->rules['*##*##'.$actions])
                ){
            if($this->rules['*##*##*']==1 || 
                    $this->rules[$module.'##'.$controller.'##*'] == 1 ||
                    $this->rules['*##'.$controller.'##*'] ==1 ||
                    $this->rules['*##*##'.$actions] == 1
                    ) 
                $permission = true;
        }
        foreach($this->rules as $rules=>$status){
            list($moduleName,$controllerName,$actionName) = explode('##',$rules);
            if($moduleName==$module && $controllerName == $controller && $actionName == $actions){
                if($status == 1){
                    $permission = true;
                }else{
                    $permission = false;
                }
            }
        }        
        return $permission;
    }
    
    private function checkControllerAccess($module,$controller) {
        $permission = false;
        if(isset($this->rules['*##*##*']) || 
                isset($this->rules['*##'.$controller.'##*']) ||
                isset($this->rules[$module.'##'.$controller.'##*'])){
            if($this->rules['*##*##*']==1 || $this->rules['*##'.$controller.'##*'] == 1 || $this->rules[$module.'##'.$controller.'##*'] == 1) 
                $permission = true;
        }
        foreach($this->rules as $rules=>$status){
            list($moduleName,$controllerName,$actionName) = explode('##',$rules);
            if(($moduleName==$module && $controllerName == $controller)|| ($moduleName=='*' && $controllerName == $controller)|| ($moduleName=='*' && $controllerName == '*')){
                if($status == 1){
                    $permission = true;
                }else{
                    $permission = false;
                }
            }
        }
        //\yii::trace('Module Permission for '.$module.'\\'.$controller.':'.(bool)$permission,'app.permissionTrait');
        return $permission;
    }
    
    private function checkModuleAccess($module) {
        $permission = false;
        if(isset($this->rules['*##*##*']) || isset($this->rules[$module.'##*##*'])){
            if($this->rules['*##*##*']==1 || $this->rules[$module.'##*##*'] == 1) $permission = true;
            //\yii::trace('Module Permission:'.__LINE__.'check'.$permission,'app.permissionTrait');
        }
        foreach($this->rules as $rules=>$status){           
            list($moduleName,$controllerName,$actionName) = explode('##',$rules);
            if($moduleName == $module || $moduleName=='*'){
                if($status == 1){
                    $permission = true;
                }else{
                    $permission = false;
                }
                
            }
            //\yii::trace('Module Permission:'.__LINE__.'check'.$permission,'app.permissionTrait');
        }
        //\yii::trace('Module Permission for '.$module.':'.(bool)$permission,'app.permissionTrait');
        return $permission;
    }
}