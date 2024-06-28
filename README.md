# QuickCRUD

QuickCRUD is a Laravel-based project designed to streamline and accelerate the creation of full CRUD (Create, Read, Update, Delete) operations. This powerful tool enables developers to generate all necessary files and configurations for a new entity within minutes, significantly reducing development time and effort.

## Features

- **Rapid Setup**: Clone the repository, set up Composer, run migrations and seed the database, and you’re ready to go.
- **Automated CRUD Generation**: Use the intuitive admin panel to create new entities. QuickCRUD automatically generates the migration file, model, controller, request, resource, Blade views, and JavaScript for the specified entity.
- **User-Friendly Interface**: The admin panel provides a straightforward interface for configuring new pages and managing existing ones.
- **Flexible Configuration**: Easily configure settings for each entity to customize the generated files according to your requirements.
- **Efficient Development**: Reduce repetitive coding tasks and focus on building unique features for your application.

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/SeniorMahmoudBadr/QuickCRUD.git
    cd QuickCRUD
    ```

2. Install dependencies:
    ```bash
    composer install
    ```

3. Copy the `.env` file and set up your environment variables:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. Run migrations and seed the database:
    ```bash
    php artisan migrate --seed
    ```

5. Serve the application:
    ```bash
    php artisan serve
    ```

## Usage

1. Access the admin panel: http://localhost:8000/admin


2. Create a new CRUD page:
- Navigate to the "Create Page" section.
- Enter the name of the entity (e.g., "Category").
- Configure the necessary settings.
- The system will generate the required files (migration, model, controller, request, resource, Blade views, and JavaScript).

3. Verify the generated files and make any necessary adjustments.

4. **Handle columns in the migration file**:
- Open the generated migration file (e.g., `2024_06_27_123456_create_categories_table.php`).
- Add the necessary columns to the migration file:
    ```php
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_ar');
            $table->text('description')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }
    ```

5. **Handle validation rules in the request file**:
- Open the generated request file (e.g., `CategoryRequest.php`).
- Add the necessary validation rules:
    ```php
    public function rules()
    {
        return [
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'description' => 'nullable|string',
        ];
    }
    ```

6. Run the migrations:
 ```bash
 php artisan migrate
 ```

## Contribution

Contributions are welcome! If you have suggestions for improvements or want to report issues, please create an issue or submit a pull request.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.



