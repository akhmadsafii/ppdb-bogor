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

namespace Google\Service\AndroidManagement;

class ChoosePrivateKeyRule extends \Google\Collection
{
  protected $collection_key = 'packageNames';
  /**
   * @var string[]
   */
  public $packageNames = [];
  /**
   * @var string
   */
  public $privateKeyAlias;
  /**
   * @var string
   */
  public $urlPattern;

  /**
   * @param string[]
   */
  public function setPackageNames($packageNames)
  {
    $this->packageNames = $packageNames;
  }
  /**
   * @return string[]
   */
  public function getPackageNames()
  {
    return $this->packageNames;
  }
  /**
   * @param string
   */
  public function setPrivateKeyAlias($privateKeyAlias)
  {
    $this->privateKeyAlias = $privateKeyAlias;
  }
  /**
   * @return string
   */
  public function getPrivateKeyAlias()
  {
    return $this->privateKeyAlias;
  }
  /**
   * @param string
   */
  public function setUrlPattern($urlPattern)
  {
    $this->urlPattern = $urlPattern;
  }
  /**
   * @return string
   */
  public function getUrlPattern()
  {
    return $this->urlPattern;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(ChoosePrivateKeyRule::class, 'Google_Service_AndroidManagement_ChoosePrivateKeyRule');
