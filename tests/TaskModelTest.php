<?php

namespace Tests;

require 'app/Core/bootstrap.php';

use App\Models\Task;
use PHPUnit\Framework\TestCase;

class TaskModelTest extends TestCase
{
    public function testValidateNameSuccess()
    {
        $result = Task::validateName('Cj');
        $expected = true;

        $this->assertSame($expected, $result);
    }

    public function testValidateNameFailure()
    {
        $this->expectException(\Exception::class);
        Task::validateName('');
    }

    public function testValidateUserSuccess()
    {
        $result = Task::validateUser(1);
        $expected = true;

        $this->assertSame($expected, $result);
    }

    public function testValidateUserFailure()
    {
        $this->expectException(\Exception::class);
        Task::validateUser('11');
    }

    public function testValidateStatusFailureSuccess()
    {
        $result = Task::validateStatus(1);
        $expected = true;

        $this->assertSame($expected, $result);
    }

    public function testValidateStatusFailure()
    {
        $this->expectException(\Exception::class);
        Task::validateStatus('11');
    }

    public function testValidatePrioritySuccess()
    {
        $result = Task::validatePriority(1);
        $expected = true;

        $this->assertSame($expected, $result);
    }

    public function testValidatePriorityFailure()
    {
        $this->expectException(\Exception::class);
        Task::validatePriority('11');
    }

    //Main validate

    public function testValidateSuccess()
    {
        $post = $this->setValidateData();
        $result = Task::validate($post);
        $expected = null;

        $this->assertSame($expected, $result);
    }

    public function testValidateFailureName()
    {
        $post = $this->setValidateData(name: '');
        $result = Task::validate($post)['name'];
        $expected = 'Name must have 1-50 characters';

        $this->assertSame($expected, $result);
    }

    public function testValidateFailureUser()
    {
        $post = $this->setValidateData(user: 4);
        $result = Task::validate($post)['user'];
        $expected = 'User not exists';

        $this->assertSame($expected, $result);
    }

    public function testValidateFailureStatus()
    {
        $post = $this->setValidateData(status: 4);
        $result = Task::validate($post)['status'];
        $expected = 'Status not exists';

        $this->assertSame($expected, $result);
    }

    public function testValidateFailurePriority()
    {
        $post = $this->setValidateData(priority: 4);
        $result = Task::validate($post)['priority'];
        $expected = 'Priority not exists';

        $this->assertSame($expected, $result);
    }

    protected function setValidateData($name = 'Cj', $user = 1, $status = 1, $priority = 1): array
    {
        return [
            'task_name' => $name,
            'user_id' => $user,
            'status_id' => $status,
            'priority_id' => $priority
        ];
    }
}
