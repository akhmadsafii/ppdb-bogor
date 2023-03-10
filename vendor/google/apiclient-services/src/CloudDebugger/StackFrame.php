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

namespace Google\Service\CloudDebugger;

class StackFrame extends \Google\Collection
{
  protected $collection_key = 'locals';
  protected $argumentsType = Variable::class;
  protected $argumentsDataType = 'array';
  public $arguments = [];
  /**
   * @var string
   */
  public $function;
  protected $localsType = Variable::class;
  protected $localsDataType = 'array';
  public $locals = [];
  protected $locationType = SourceLocation::class;
  protected $locationDataType = '';
  public $location;

  /**
   * @param Variable[]
   */
  public function setArguments($arguments)
  {
    $this->arguments = $arguments;
  }
  /**
   * @return Variable[]
   */
  public function getArguments()
  {
    return $this->arguments;
  }
  /**
   * @param string
   */
  public function setFunction($function)
  {
    $this->function = $function;
  }
  /**
   * @return string
   */
  public function getFunction()
  {
    return $this->function;
  }
  /**
   * @param Variable[]
   */
  public function setLocals($locals)
  {
    $this->locals = $locals;
  }
  /**
   * @return Variable[]
   */
  public function getLocals()
  {
    return $this->locals;
  }
  /**
   * @param SourceLocation
   */
  public function setLocation(SourceLocation $location)
  {
    $this->location = $location;
  }
  /**
   * @return SourceLocation
   */
  public function getLocation()
  {
    return $this->location;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(StackFrame::class, 'Google_Service_CloudDebugger_StackFrame');
