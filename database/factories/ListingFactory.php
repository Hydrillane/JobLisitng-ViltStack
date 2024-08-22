<?php

namespace Database\Factories;

use App\Services\LogoService;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $logoService = new LogoService();

        $faker = \Faker\Factory::create('en_US');
        $createdAt = $this->faker->dateTimeBetween('-6 months', 'now');
        $updatedAt = $this->faker->dateTimeBetween($createdAt, 'now');
        $salaryMin = floor($this->faker->numberBetween(50000, 100000) / 10000) * 10000;
        $salaryMax = floor($this->faker->numberBetween($salaryMin, max($salaryMin + 30000, 200000)) / 10000) * 10000;
        $companyName = $this->faker->company();

        return [

            'position' => $faker->jobTitle(),
            'company' => $faker->company(),
            'location' => $faker->state(),
            'work_settings' => $this->faker->randomElement(['remotely', 'on-site', 'hybrid']),
            'employment_type' => $this->faker->randomElement(['Full-time', 'Part-time', 'Contract', 'Third-party']),
            'description' => $this->generateJobDescription(),
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
            'salary_min' => $salaryMin,
            'salary_max' => $salaryMax,
            'logo_url' => $logoService->getRandomLogo(),
        ];
    }


    private function generateJobDescription()
    {
        return <<<MARKDOWN

# Job Description
  {$this->faker->paragraph(3)}

# Qualifications

    {$this->faker->paragraph(2)}

- {$this->faker->sentence()}
- {$this->faker->sentence()}
- {$this->faker->sentence()}

# Employer Questions

    1. {$this->faker->sentence()}
    2. {$this->faker->sentence()}
    3. {$this->faker->sentence()}

MARKDOWN;
    }
}
