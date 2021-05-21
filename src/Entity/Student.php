<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 */
class Student
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $student_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $student_email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $student_password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $student_domain;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $student_linkedin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $student_cv;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudentName(): ?string
    {
        return $this->student_name;
    }

    public function setStudentName(string $student_name): self
    {
        $this->student_name = $student_name;

        return $this;
    }

    public function getStudentEmail(): ?string
    {
        return $this->student_email;
    }

    public function setStudentEmail(string $student_email): self
    {
        $this->student_email = $student_email;

        return $this;
    }

    public function getStudentPassword(): ?string
    {
        return $this->student_password;
    }

    public function setStudentPassword(string $student_password): self
    {
        $this->student_password = $student_password;

        return $this;
    }

    public function getStudentDomain(): ?string
    {
        return $this->student_domain;
    }

    public function setStudentDomain(string $student_domain): self
    {
        $this->student_domain = $student_domain;

        return $this;
    }

    public function getStudentLinkedin(): ?string
    {
        return $this->student_linkedin;
    }

    public function setStudentLinkedin(string $student_linkedin): self
    {
        $this->student_linkedin = $student_linkedin;

        return $this;
    }

    public function getStudentCv(): ?string
    {
        return $this->student_cv;
    }

    public function setStudentCv(string $student_cv): self
    {
        $this->student_cv = $student_cv;

        return $this;
    }
}
