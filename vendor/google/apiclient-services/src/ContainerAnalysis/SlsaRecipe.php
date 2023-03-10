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

namespace Google\Service\ContainerAnalysis;

class SlsaRecipe extends \Google\Model
{
  /**
   * @var array[]
   */
  public $arguments = [];
  /**
   * @var string
   */
  public $definedInMaterial;
  /**
   * @var string
   */
  public $entryPoint;
  /**
   * @var array[]
   */
  public $environment = [];
  /**
   * @var string
   */
  public $type;

  /**
   * @param array[]
   */
  public function setArguments($arguments)
  {
    $this->arguments = $arguments;
  }
  /**
   * @return array[]
   */
  public function getArguments()
  {
    return $this->arguments;
  }
  /**
   * @param string
   */
  public function setDefinedInMaterial($definedInMaterial)
  {
    $this->definedInMaterial = $definedInMaterial;
  }
  /**
   * @return string
   */
  public function getDefinedInMaterial()
  {
    return $this->definedInMaterial;
  }
  /**
   * @param string
   */
  public function setEntryPoint($entryPoint)
  {
    $this->entryPoint = $entryPoint;
  }
  /**
   * @return string
   */
  public function getEntryPoint()
  {
    return $this->entryPoint;
  }
  /**
   * @param array[]
   */
  public function setEnvironment($environment)
  {
    $this->environment = $environment;
  }
  /**
   * @return array[]
   */
  public function getEnvironment()
  {
    return $this->environment;
  }
  /**
   * @param string
   */
  public function setType($type)
  {
    $this->type = $type;
  }
  /**
   * @return string
   */
  public function getType()
  {
    return $this->type;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(SlsaRecipe::class, 'Google_Service_ContainerAnalysis_SlsaRecipe');
