<?php

namespace Craft;

class RedirectorService extends BaseApplicationComponent
{
 	public function findByUrl($url){
    return RedirectorRecord::model()->findByAttributes(array('urlPattern' => $url));
 	}

  public function findAll(){
    return RedirectorRecord::model()->findAll();
  }

  public function findByEntryId($entryId, $locale){
    $redirect = RedirectorRecord::model()->findByAttributes(array('targetEntryId' => $entryId, 'locale' => $locale));
    return $redirect;
  }

  public function createOrUpdate($entryId, $locale, $urlPattern) {
    $existingEntry = $this->findByEntryId($entryId, $locale);
    if ($existingEntry)
    {
      $existingEntry->urlPattern = $urlPattern;
      $existingEntry->save();
    } else {
      $this->create($entryId, $locale, $urlPattern);
    }
  }

  public function create($entryId, $locale, $urlPattern) {
    $record = new RedirectorRecord;
    $record->targetEntryId = $entryId;
    $record->urlPattern = $urlPattern;
    $record->locale = $locale;
    $record->save();
  }

}