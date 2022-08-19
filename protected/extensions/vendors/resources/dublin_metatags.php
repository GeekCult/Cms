<?php

Yii::app()->clientScript->registerMetaTag($_SERVER['SERVER_NAME'], 'dcterms.identifier', null, array());
Yii::app()->clientScript->registerMetaTag('text/html', 'dcterms.format', null, array());
if(isset($result['attributes']['dc_title']))Yii::app()->clientScript->registerMetaTag($result['attributes']['dc_title'], 'dc.title', null, array('xml:lang' => 'PT', 'lang' => 'PT'));
if(isset($result['attributes']['dc_creator']))Yii::app()->clientScript->registerMetaTag($result['attributes']['dc_creator'], 'dcterms.creator', null, array());
if(isset($result['attributes']['dc_subject']))Yii::app()->clientScript->registerMetaTag($result['attributes']['dc_subject'], 'dcterms.subject', null, array('xml:lang' => 'PT', 'lang' => 'PT'));
if(isset($result['attributes']['dc_publisher']))Yii::app()->clientScript->registerMetaTag($result['attributes']['dc_publisher'], 'dcterms.publisher', null, array());
//if(isset($result['attributes']['dc_email']))Yii::app()->clientScript->registerMetaTag($result['attributes']['dc_email'], 'dcterms.Publisher.Address', null, array());
if(isset($result['attributes']['dc_contributor']))Yii::app()->clientScript->registerMetaTag($result['attributes']['dc_contributor'], 'dcterms.contributor', null, array());
if(isset($result['attributes']['dc_date']))Yii::app()->clientScript->registerMetaTag($result['attributes']['dc_date'], 'dcterms.Date', null, array('scheme' => 'ISO8601'));      
Yii::app()->clientScript->registerMetaTag('text/html', 'dcterms.Type', null, array());
if(isset($result['attributes']['dc_description']))Yii::app()->clientScript->registerMetaTag($result['attributes']['dc_description'], 'dcterms.description', null, array('xml:lang' => 'PT', 'lang' => 'PT'));
Yii::app()->clientScript->registerMetaTag($_SERVER['SERVER_NAME'], 'dcterms.Identifier', null, array());
if(isset($result['attributes']['dc_relation']))Yii::app()->clientScript->registerMetaTag($result['attributes']['dc_relation'], 'dcterms.relation', null, array());
if(isset($result['attributes']['dc_coverage']))Yii::app()->clientScript->registerMetaTag($result['attributes']['dc_coverage'], 'dcterms.coverage', null, array());   
if(isset($result['attributes']['dc_copyright']))Yii::app()->clientScript->registerMetaTag($result['attributes']['dc_copyright'], 'dcterms.rights', null, array());
if(isset($result['attributes']['dc_lastupdate']))Yii::app()->clientScript->registerMetaTag($result['attributes']['dc_lastupdate'],'dcterms.modified', null, array());
Yii::app()->clientScript->registerMetaTag('PT', 'dcterms.language', null, array());

?>
