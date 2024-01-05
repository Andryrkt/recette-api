<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\HasIdtrait;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\RecipeHasIngredientRepository;

#[ORM\Entity(repositoryClass: RecipeHasIngredientRepository::class)]
#[ApiResource()]
class RecipeHasIngredient
{
    use HasIdtrait;

    #[ORM\Column]
    private ?float $quantity = null;

    #[ORM\Column]
    private ?bool $optional = null;

    #[ORM\ManyToOne(inversedBy: 'recipeHasIngredients')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ingredient $ingredient = null;

    #[ORM\ManyToOne(inversedBy: 'recipehasingredient')]
    private ?Unit $unit = null;

    #[ORM\ManyToOne(inversedBy: 'recipehasingredient')]
    private ?IngredientGroup $ingredientGroup = null;

    #[ORM\ManyToOne(inversedBy: 'recipeHasIngredients')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Recipe $recipe = null;


    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function isOptional(): ?bool
    {
        return $this->optional;
    }

    public function setOptional(bool $optional): static
    {
        $this->optional = $optional;

        return $this;
    }

    public function getIngredient(): ?Ingredient
    {
        return $this->ingredient;
    }

    public function setIngredient(?Ingredient $ingredient): static
    {
        $this->ingredient = $ingredient;

        return $this;
    }

    public function getUnit(): ?Unit
    {
        return $this->unit;
    }

    public function setUnit(?Unit $unit): static
    {
        $this->unit = $unit;

        return $this;
    }

    public function getIngredientGroup(): ?IngredientGroup
    {
        return $this->ingredientGroup;
    }

    public function setIngredientGroup(?IngredientGroup $ingredientGroup): static
    {
        $this->ingredientGroup = $ingredientGroup;

        return $this;
    }

    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    public function setRecipe(?Recipe $recipe): static
    {
        $this->recipe = $recipe;

        return $this;
    }
}
