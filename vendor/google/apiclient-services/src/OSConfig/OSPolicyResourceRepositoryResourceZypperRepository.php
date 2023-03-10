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

namespace Google\Service\OSConfig;

class OSPolicyResourceRepositoryResourceZypperRepository extends \Google\Collection
{
  protected $collection_key = 'gpgKeys';
  /**
   * @var string
   */
  public $baseUrl;
  /**
   * @var string
   */
  public $displayName;
  /**
   * @var string[]
   */
  public $gpgKeys = [];
  /**
   * @var string
   */
  public $id;

  /**
   * @param string
   */
  public function setBaseUrl($baseUrl)
  {
    $this->baseUrl = $baseUrl;
  }
  /**
   * @return string
   */
  public function getBaseUrl()
  {
    return $this->baseUrl;
  }
  /**
   * @param string
   */
  public function setDisplayName($displayName)
  {
    $this->displayName = $displayName;
  }
  /**
   * @return string
   */
  public function getDisplayName()
  {
    return $this->displayName;
  }
  /**
   * @param string[]
   */
  public function setGpgKeys($gpgKeys)
  {
    $this->gpgKeys = $gpgKeys;
  }
  /**
   * @return string[]
   */
  public function getGpgKeys()
  {
    return $this->gpgKeys;
  }
  /**
   * @param string
   */
  public function setId($id)
  {
    $this->id = $id;
  }
  /**
   * @return string
   */
  public function getId()
  {
    return $this->id;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(OSPolicyResourceRepositoryResourceZypperRepository::class, 'Google_Service_OSConfig_OSPolicyResourceRepositoryResourceZypperRepository');
