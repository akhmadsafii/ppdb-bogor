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

namespace Google\Service\IdentityToolkit;

class IdentitytoolkitRelyingpartyGetAccountInfoRequest extends \Google\Collection
{
  protected $collection_key = 'phoneNumber';
  /**
   * @var string
   */
  public $delegatedProjectNumber;
  /**
   * @var string[]
   */
  public $email = [];
  /**
   * @var string
   */
  public $idToken;
  /**
   * @var string[]
   */
  public $localId = [];
  /**
   * @var string[]
   */
  public $phoneNumber = [];

  /**
   * @param string
   */
  public function setDelegatedProjectNumber($delegatedProjectNumber)
  {
    $this->delegatedProjectNumber = $delegatedProjectNumber;
  }
  /**
   * @return string
   */
  public function getDelegatedProjectNumber()
  {
    return $this->delegatedProjectNumber;
  }
  /**
   * @param string[]
   */
  public function setEmail($email)
  {
    $this->email = $email;
  }
  /**
   * @return string[]
   */
  public function getEmail()
  {
    return $this->email;
  }
  /**
   * @param string
   */
  public function setIdToken($idToken)
  {
    $this->idToken = $idToken;
  }
  /**
   * @return string
   */
  public function getIdToken()
  {
    return $this->idToken;
  }
  /**
   * @param string[]
   */
  public function setLocalId($localId)
  {
    $this->localId = $localId;
  }
  /**
   * @return string[]
   */
  public function getLocalId()
  {
    return $this->localId;
  }
  /**
   * @param string[]
   */
  public function setPhoneNumber($phoneNumber)
  {
    $this->phoneNumber = $phoneNumber;
  }
  /**
   * @return string[]
   */
  public function getPhoneNumber()
  {
    return $this->phoneNumber;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(IdentitytoolkitRelyingpartyGetAccountInfoRequest::class, 'Google_Service_IdentityToolkit_IdentitytoolkitRelyingpartyGetAccountInfoRequest');
