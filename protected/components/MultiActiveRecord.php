<?php

/**
* MultiActiveRecord provide a separate DbConnection for using multiple-database support.
*
* @author dinhtrung
*
*/
abstract class MultiActiveRecord extends CActiveRecord {
   
   /**
    * @var CDbConnection the default database connection for all active record classes.
    * By default, this is the 'db' application component.
    * @see getDbConnection
    */
    public static $db;
    
    /**
    * Returns the database connection used by active record.
    * By default, the "db" application component is used as the database connection.
    * If you override the method connectionId it will use this connection.
    *
    * @return CDbConnection the database connection used by active record.
    */
    public function getDbConnection()
    {
        $dbName = $this->connectionId();

        if(!isset(self::$db[$dbName])){
            if(Yii::app()->hasComponent($dbName) && (self::$db[$dbName]=Yii::app()->getComponent($dbName)) instanceof CDbConnection){
                self::$db[$dbName]->setActive(true);
            }else
                throw new CDbException(Yii::t('app','Active Record requires a :dbname CDbConnection application component.', array(':dbname' => $dbName)));
        }

        return self::$db[$dbName];
    }
        /**
    * workaround to try the model's name, if not given
    * doesnt always work, and thats the reason its not included in the framework's core
    *
    * @param string $className
    * @return CModel
    */
    public static function model($className=__CLASS__){
        if($className===__CLASS__){
            if(version_compare(PHP_VERSION,'5.3',">"))
                $className=get_called_class();
            else
                throw new CException("You must define a static function 'model' in your models");
        }
        return parent::model($className);
    }
        /**
    * try to guess the model's name, models should override this function to improve speed and better customization
    * it does the inverse process of gii's model creator
    *
    * @return string name of the class table
    */
    public function tableName(){
        $tableName=get_class($this);
        $tableName=strtolower(substr($tableName,0,1)).substr($tableName,1);
        $tableName=preg_replace_callback('/([A-Z])/',create_function('$matches','return "_".strtolower($matches[0]);'),$tableName);
        return $tableName;
    }
    
   /**
    * define which connection to use in the model, default to 'db'
    *
    * @return string
    */
    public function connectionId($database = 'db2'){
        
        return $database;
    }
}

?>
