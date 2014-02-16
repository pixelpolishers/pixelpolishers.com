<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolCli;

use PixPolEmployee\Entity\Employee;
use PixPolUser\Entity\Role;
use PixPolUser\Entity\User;

class Installer extends AbstractCommand
{
    public function run()
    {
        $this->createUserTable();
        $this->createRoleTable();
        $this->createRoleUserTable();
        $this->createEmployeeTable();

        $userService = $this->getServiceLocator()->get('PixPolUser\Service\User');
        $roleService = $this->getServiceLocator()->get('PixPolUser\Service\Role');
        $employeeService = $this->getServiceLocator()->get('PixPolEmployee\Service\Employee');

        $role = new Role();
        $role->setName('Owners');
        $roleService->persist($role);

        $rootUser = new User();
        $rootUser->setEmail('w.tamboer@pixelpolishers.com');
        $rootUser->setName('Walter');
        $rootUser->setSurname('Tamboer');
        $rootUser->setRegistrationDate(new \DateTime());
        $rootUser->setPassword($userService->getPassword()->create('test'));
        $rootUser->addRole($role);
        $userService->persist($rootUser);

        $employee = new Employee();
        $employee->setUser($rootUser);
        $employeeService->persist($employee);
    }

    private function createRoleTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `role` (
            `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` varchar(255) DEFAULT NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `unique_name` (`name`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
        $this->query($sql);
    }

    private function createRoleUserTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `role_user` (
            `role_id` int(10) UNSIGNED NOT NULL,
            `user_id` int(10) UNSIGNED NOT NULL,
            PRIMARY KEY (`role_id`, `user_id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
        $this->query($sql);

        $sql = "ALTER TABLE `role_user`
                ADD CONSTRAINT `role_user_role`
                FOREIGN KEY (`role_id`)
                REFERENCES `role`(`id`)
                ON DELETE CASCADE
                ON UPDATE NO ACTION;";
        $this->query($sql);

        $sql = "ALTER TABLE `role_user`
                ADD CONSTRAINT `role_user_user`
                FOREIGN KEY (`user_id`)
                REFERENCES `user`(`id`)
                ON DELETE CASCADE
                ON UPDATE NO ACTION;";
        $this->query($sql);
    }

    private function createUserTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `user` (
            `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
            `email` varchar(255) NOT NULL,
            `password` varchar(255) NOT NULL,
            `name` varchar(255) DEFAULT NULL,
            `surname` varchar(255) DEFAULT NULL,
            `displayName` varchar(255) DEFAULT NULL,
            `registrationDate` datetime NOT NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `unique_email` (`email`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
        $this->query($sql);
    }

    private function createEmployeeTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `employee` (
            `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
            `user_id` int(10) UNSIGNED NOT NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `unique_user` (`user_id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
        $this->query($sql);

        $sql = "ALTER TABLE `employee`
                ADD CONSTRAINT `employee_user`
                FOREIGN KEY (`user_id`)
                REFERENCES `user`(`id`)
                ON DELETE CASCADE
                ON UPDATE NO ACTION;";
        $this->query($sql);
    }
}
