<?hh // strict
/**
 * Copyright (c) 2016-present, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the BSD-style license found in the
 * LICENSE file in the root directory of this source tree. An additional grant
 * of patent rights can be found in the PATENTS file in the same directory.
 */
namespace Facebook\ShipIt;

class ShipItShellCommandException extends \Exception {
  public function __construct(
    private string $command,
    private ShipItShellCommandResult $result,
  ) {
    $exitCode = $result->getExitCode();
    $error = $result->getStdErr();
    if (((string) \trim($error)) === '') {
      $error = $result->getStdOut();
    }
    $message = \sprintf(
      '%s returned exit code %s: %s',
      $command,
      $exitCode,
      \trim($error),
    );
    parent::__construct($message);
  }

  public function getError(): string {
    return $this->result->getStdErr();
  }

  public function getExitCode(): int {
    return $this->result->getExitCode();
  }

  public function getOutput(): string {
    return $this->result->getStdOut();
  }

  public function getResult(): ShipItShellCommandResult {
    return $this->result;
  }
}
