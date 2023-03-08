<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Google\Service\ChromeUXReport;

class HistoryRecord extends \Google\Collection
{
  protected $collection_key = 'collectionPeriods';
  protected $collectionPeriodsType = CollectionPeriod::class;
  protected $collectionPeriodsDataType = 'array';
  public $collectionPeriods = [];
  protected $keyType = HistoryKey::class;
  protected $keyDataType = '';
  public $key;
  protected $metricsType = MetricTimeseries::class;
  protected $metricsDataType = 'map';
  public $metrics = [];

  /**
   * @param CollectionPeriod[]
   */
  public function setCollectionPeriods($collectionPeriods)
  {
    $this->collectionPeriods = $collectionPeriods;
  }
  /**
   * @return CollectionPeriod[]
   */
  public function getCollectionPeriods()
  {
    return $this->collectionPeriods;
  }
  /**
   * @param HistoryKey
   */
  public function setKey(HistoryKey $key)
  {
    $this->key = $key;
  }
  /**
   * @return HistoryKey
   */
  public function getKey()
  {
    return $this->key;
  }
  /**
   * @param MetricTimeseries[]
   */
  public function setMetrics($metrics)
  {
    $this->metrics = $metrics;
  }
  /**
   * @return MetricTimeseries[]
   */
  public function getMetrics()
  {
    return $this->metrics;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(HistoryRecord::class, 'Google_Service_ChromeUXReport_HistoryRecord');
