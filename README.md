# smarttuition

#Tutors to register as users, post tuition details, and edit or modify the postings.

#Students to view postings according to the latest posting, tutor, and categories.
The posting may also include a picture of the tutor with their current students for
the particular subject.

 
**Install existing package**
**Step 1: Clone the Repository**

First, clone the Laravel project from GitHub:

 git clone <repository-url>
 cd <project-directory>

Replace <repository-url> with the actual GitHub repository URL.

**Step 2: Install Dependencies**

Run the following command to install the necessary dependencies:

composer update

**Step 3: Configure Environment File**

Rename the example environment file:

mv .env.example .env

Modify the .env file to configure the database connection. Open it in a text editor and update the database details:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=smarttuition
DB_USERNAME=root
DB_PASSWORD=

Adjust the credentials as per your MySQL setup.

**Step 4: Generate Application Key**

Run the following command to generate an application key:

php artisan key:generate

**Step 5: Run Migrations**

To set up the database structure, execute:

php artisan migrate

**Step 6: Serve the Application**

Start the Laravel development server:

php artisan serve

By default, the application will be available at http://127.0.0.1:8000.

Additional Steps
#To enable storage linking for images:
php artisan storage:link

#To seed the database with sample data:
php artisan db:seed

Now your Laravel application is set up and ready to use!
