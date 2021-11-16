<?php

namespace Tests;

require '../app/Core/bootstrap.php';

use App\Validators\TaskValidator;
use PHPUnit\Framework\TestCase;

class TaskValidatorTest extends TestCase
{
    public function testValidateNameSuccess()
    {
        $result = TaskValidator::validateName('Cj');
        $expected = true;

        $this->assertSame($expected, $result);
    }

    public function testValidateNameFailure()
    {
        $this->expectException(\Exception::class);
        TaskValidator::validateName('');
    }

    public function testValidateUserSuccess()
    {
        $result = TaskValidator::validateUser(1);
        $expected = true;

        $this->assertSame($expected, $result);
    }

    public function testValidateUserFailure()
    {
        $this->expectException(\Exception::class);
        TaskValidator::validateUser('11');
    }

    public function testValidateStatusFailureSuccess()
    {
        $result = TaskValidator::validateStatus(1);
        $expected = true;

        $this->assertSame($expected, $result);
    }

    public function testValidateStatusFailure()
    {
        $this->expectException(\Exception::class);
        TaskValidator::validateStatus('11');
    }

    public function testValidatePrioritySuccess()
    {
        $result = TaskValidator::validatePriority(1);
        $expected = true;

        $this->assertSame($expected, $result);
    }

    public function testValidatePriorityFailure()
    {
        $this->expectException(\Exception::class);
        TaskValidator::validatePriority('11');
    }

    //Main validate

//    public function testValidateSuccess()
//    {
//        $post = $this->setValidateData();
//
//        $result = TaskValidator::validate($post);
//        $expected = $post;
//
//        $this->assertSame($expected, $result);
//    }

    public function testValidateFailureName()
    {
        $post = $this->setValidateData(name: '');
        $result = TaskValidator::validate($post);
        $expected = false;

        $this->assertSame($expected, $result);
    }

    public function testValidateFailureUser()
    {
        $post = $this->setValidateData(user: 4);
        $result = TaskValidator::validate($post);
        $expected = false;

        $this->assertSame($expected, $result);
    }

    public function testValidateFailureStatus()
    {
        $post = $this->setValidateData(status: 4);
        $result = TaskValidator::validate($post);
        $expected = false;

        $this->assertSame($expected, $result);
    }

    public function testValidateFailurePriority()
    {
        $post = $this->setValidateData(priority: 4);
        $result = TaskValidator::validate($post);
        $expected = false;

        $this->assertSame($expected, $result);
    }

    public function setValidateData($name = 'Cj', $user = 1, $status = 1, $priority = 1): array
    {
        return [
            'name' => $name,
            'user_id' => $user,
            'status_id' => $status,
            'priority_id' => $priority
        ];
    }
}
