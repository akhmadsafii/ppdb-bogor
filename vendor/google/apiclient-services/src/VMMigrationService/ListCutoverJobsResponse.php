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

namespace Google\Service\VMMigrationService;

class ListCutoverJobsResponse extends \Google\Collection
{
  protected $collection_key = 'unreachable';
  protected $cutoverJobsType = CutoverJob::class;
  protected $cutoverJobsDataType = 'array';
  public $cutoverJobs = [];
  /**
   * @var string
   */
  public $nextPageToken;
  /**
   * @var string[]
   */
  public $unreachable = [];

  /**
   * @param CutoverJob[]
   */
  public function setCutoverJobs($cutoverJobs)
  {
    $this->cutoverJobs = $cutoverJobs;
  }
  /**
   * @return CutoverJob[]
   */
  public function getCutoverJobs()
  {
    return $this->cutoverJobs;
  }
  /**
   * @param string
   */
  public function setNextPageToken($nextPageToken)
  {
    $this->nextPageToken = $nextPageToken;
  }
  /**
   * @return string
   */
  public function getNextPageToken()
  {
    return $this->nextPageToken;
  }
  /**
   * @param string[]
   */
  public function setUnreachable($unreachable)
  {
    $this->unreachable = $unreachable;
  }
  /**
   * @return string[]
   */
  public function getUnreachable()
  {
    return $this->unreachable;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(ListCutoverJobsResponse::class, 'Google_Service_VMMigrationService_ListCutoverJobsResponse');
