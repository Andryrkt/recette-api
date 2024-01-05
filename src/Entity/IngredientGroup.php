<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\HasIdtrait;
use App\Entity\Traits\HasNametrait;
use ApiPlatform\Metadata\ApiResource;
use App\Entity\Traits\HasPrioritytrait;
use Doctrine\Common\Collections\Collection;
use App\Repository\IngredientGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: IngredientGroupRepository::class)]
#[ApiResource()]
class IngredientGroup
{
    use HasIdtrait;

    use HasNametrait;

    use HasPrioritytrait;

    #[ORM\OneToMany(mappedBy: 'ingredientGroup', targetEntity: RecipeHasIngredient::class)]
    private Collection $recipehasingredient;

    public function __construct()
    {
        $this->recipehasingredient = new ArrayCollection();
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
            $recipehasingredient->setIngredientGroup($this);
        }

        return $this;
    }

    public function removeRecipehasingredient(RecipeHasIngredient $recipehasingredient): static
    {
        if ($this->recipehasingredient->removeElement($recipehasingredient)) {
            // set the owning side to null (unless already changed)
            if ($recipehasingredient->getIngredientGroup() === $this) {
                $recipehasingredient->setIngredientGroup(null);
            }
        }

        return $this;
    }
}
