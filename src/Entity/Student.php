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
    private $student_domain;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $student_linkedin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $student_cv;

    /**
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="student", cascade={"persist", "remove"})
     */
    private $user;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setStudent(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getStudent() !== $this) {
            $user->setStudent($this);
        }

        $this->user = $user;

        return $this;
    }
}
