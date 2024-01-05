<?php

namespace App\Entity;

use App\Entity\Traits\HasIdtrait;
use App\Repository\UnitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UnitRepository::class)]
class Unit
{
    use HasIdtrait;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $singular = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $plural = null;

    #[ORM\OneToMany(mappedBy: 'unit', targetEntity: RecipeHasIngredient::class)]
    private Collection $recipehasingredient;

    public function __construct()
    {
        $this->recipehasingredient = new ArrayCollection();
    }


    public function getSingular(): ?string
    {
        return $this->singular;
    }

    public function setSingular(?string $singular): static
    {
        $this->singular = $singular;

        return $this;
    }

    public function getPlural(): ?string
    {
        return $this->plural;
    }

    public function setPlural(?string $plural): static
    {
        $this->plural = $plural;

        return $this;
    }

    /**
     * @return Collection<int, RecipeHasIngredient>
     */
    public function getRecipehasingredient(): Collection
    {
        return $this->recipehasingredient;
    }

    public function addRecipehasingredient(RecipeHasIngredient $recipehasingredient): static
    {
        if (!$this->recipehasingredient->contains($recipehasingredient)) {
            $this->recipehasingredient->add($recipehasingredient);
            $recipehasingredient->setUnit($this);
        }

        return $this;
    }

    public function removeRecipehasingredient(RecipeHasIngredient $recipehasingredient): static
    {
        if ($this->recipehasingredient->removeElement($recipehasingredient)) {
            // set the owning side to null (unless already changed)
            if ($recipehasingredient->getUnit() === $this) {
                $recipehasingredient->setUnit(null);
            }
        }

        return $this;
    }
}
