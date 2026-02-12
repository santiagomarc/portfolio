<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Project;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed Marc Santiago's actual resume data
     */
    public function run(): void
    {
        // Create or get the user
        $user = User::firstOrCreate(
            ['email' => 'santiagomarcstephen@gmail.com'],
            [
                'name' => 'Marc Santiago',
                'password' => Hash::make('adminpass'),
            ]
        );
        
        // Update user info
        $user->update([
            'name' => 'Marc Santiago',
            'email' => 'santiagomarcstephen@gmail.com',
            'password' => Hash::make('adminpass'),
        ]);
        
        // Delete existing data to avoid duplicates
        $user->profile()->delete();
        $user->skills()->delete();
        $user->experiences()->delete();
        $user->education()->delete();
        $user->projects()->delete();
        
        // Create/Update Profile
        Profile::create([
            'user_id' => $user->id,
            'full_name' => 'Marc Santiago',
            'title' => '3rd Year BS Computer Science Student',
            'phone' => '+63 9081209820',
            'location' => 'Calamba, Laguna',
            'website' => null,
            'linkedin' => null,
            'github' => 'https://github.com/santiagomarc',
            'bio' => '3rd Year Computer Science student at Batangas State University with a passion for web development, data science, and software engineering. Experienced in full-stack development using Laravel, PHP, Python, and various modern technologies.',
        ]);
        
        // Create Skills (from getSkills() method in ResumeController)
        $skillsData = [
            // Frontend Development
            ['name' => 'HTML5 & CSS3', 'category' => 'Frontend Development', 'proficiency_level' => 80],
            ['name' => 'JavaScript', 'category' => 'Frontend Development', 'proficiency_level' => 75],
            ['name' => 'Dart & Flutter', 'category' => 'Frontend Development', 'proficiency_level' => 70],
            ['name' => 'Bootstrap', 'category' => 'Frontend Development', 'proficiency_level' => 80],
            
            // Backend Development
            ['name' => 'PHP', 'category' => 'Backend Development', 'proficiency_level' => 80],
            ['name' => 'Laravel Framework', 'category' => 'Backend Development', 'proficiency_level' => 70],
            ['name' => 'MySQL/PostgreSQL', 'category' => 'Backend Development', 'proficiency_level' => 90],
            ['name' => 'RESTful APIs', 'category' => 'Backend Development', 'proficiency_level' => 75],
            
            // Tools & Technologies
            ['name' => 'Git & GitHub', 'category' => 'Tools & Technologies', 'proficiency_level' => 90],
            ['name' => 'VS Code', 'category' => 'Tools & Technologies', 'proficiency_level' => 95],
            ['name' => 'XAMPP/PGAdmin', 'category' => 'Tools & Technologies', 'proficiency_level' => 75],
            ['name' => 'Responsive Design', 'category' => 'Tools & Technologies', 'proficiency_level' => 85],
            
            // Programming Languages
            ['name' => 'Python', 'category' => 'Programming Languages', 'proficiency_level' => 95],
            ['name' => 'Java', 'category' => 'Programming Languages', 'proficiency_level' => 75],
            ['name' => 'C#', 'category' => 'Programming Languages', 'proficiency_level' => 70],
            ['name' => 'C++', 'category' => 'Programming Languages', 'proficiency_level' => 75],
        ];
        
        foreach ($skillsData as $skill) {
            Skill::create(array_merge(['user_id' => $user->id], $skill));
        }
        
        // Create Experience (from getExperience() method)
        $experiencesData = [
            [
                'job_title' => 'Full Stack Developer',
                'company_details' => 'TechCorp Solutions | Remote | Jan 2023 - Present',
                'description' => "• Developed responsive web applications using Laravel and React.js\n• Collaborated with cross-functional teams to deliver high-quality software solutions\n• Implemented RESTful APIs and integrated third-party services\n• Optimized database queries resulting in 40% improvement in application performance",
            ],
            [
                'job_title' => 'Web Development Intern',
                'company_details' => 'WebStart Agency | Remote | Jun 2022 - Dec 2022',
                'description' => "• Assisted in building client websites using PHP, HTML, CSS, and JavaScript\n• Learned version control best practices using Git and GitHub\n• Participated in code reviews and agile development processes\n• Contributed to documentation and testing of web applications",
            ],
        ];
        
        foreach ($experiencesData as $experience) {
            Experience::create(array_merge(['user_id' => $user->id], $experience));
        }
        
        // Create Education (from getEducation() method)
        $educationData = [
            [
                'degree' => 'Bachelor of Science in Computer Science',
                'school_details' => 'Batangas State University | Batangas | 2023 - Present',
                'description' => 'Relevant Coursework: Data Structures, Web Development, Database Systems, Software Engineering',
            ],
            [
                'degree' => 'Senior High School in STEM Track',
                'school_details' => 'Philippine Christian University - Dasmarinas | Dasmarinas, Cavite | 2021 - 2023',
                'description' => 'Graduated with High Honors',
            ],
        ];
        
        foreach ($educationData as $education) {
            Education::create(array_merge(['user_id' => $user->id], $education));
        }
        
        // Create Projects (using new schema columns)
        $projectsData = [
            [
                'title' => 'Laravel Portfolio with Authentication',
                'description' => 'A professional portfolio website built with Laravel framework featuring user authentication, responsive design, and dynamic content management.',
                'technologies' => 'Laravel, PHP, PostgreSQL, Blade, CSS3',
                'live_link' => null,
                'repository_link' => 'https://github.com/santiagomarc',
                'thumbnail_path' => 'images/p1.png',
                'is_featured' => true,
                'start_date' => '2024-09-01',
                'end_date' => '2024-10-22',
            ],
            [
                'title' => 'Enhanced K-Means Clustering Algorithm',
                'description' => 'Research project implementing a distance-based soft weighting mechanism for noise-handling in K-Means algorithm using Gaussian RBF weighted influence.',
                'technologies' => 'Python, NumPy, Scikit-learn, Matplotlib',
                'live_link' => null,
                'repository_link' => null,
                'thumbnail_path' => 'images/p2.png',
                'is_featured' => true,
                'start_date' => '2024-03-01',
                'end_date' => '2024-06-30',
            ],
            [
                'title' => 'Nutrition-Based Food Ordering System',
                'description' => 'Console application with GUI built using Java and MySQL, featuring nutritional information tracking and user-friendly ordering interface.',
                'technologies' => 'Java, MySQL, Swing, JDBC',
                'live_link' => null,
                'repository_link' => null,
                'thumbnail_path' => 'images/p3.png',
                'is_featured' => true,
                'start_date' => '2023-11-01',
                'end_date' => '2024-02-28',
            ],
        ];
        
        foreach ($projectsData as $project) {
            Project::create(array_merge(['user_id' => $user->id], $project));
        }
        
        $this->command->info('✅ Marc Santiago\'s resume data seeded successfully!');
    }
}
