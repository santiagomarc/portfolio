{{-- filepath: resources/views/resume/pdf.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $profile->full_name }} - Resume</title>
    <style>
        /* Reset & Base */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'DejaVu Sans', Arial, Helvetica, sans-serif;
            font-size: 11px;
            line-height: 1.5;
            color: #2c3e50;
        }

        /* Header */
        .header {
            text-align: center;
            padding-bottom: 12px;
            border-bottom: 2px solid #3498db;
            margin-bottom: 15px;
        }
        .header h1 {
            font-size: 24px;
            color: #2c3e50;
            margin-bottom: 2px;
        }
        .header .title {
            font-size: 13px;
            color: #3498db;
            margin-bottom: 6px;
        }
        .header .contact-line {
            font-size: 10px;
            color: #7f8c8d;
        }
        .header .contact-line span {
            margin: 0 6px;
        }

        /* Section */
        .section {
            margin-bottom: 14px;
        }
        .section h2 {
            font-size: 14px;
            color: #3498db;
            border-bottom: 1px solid #bdc3c7;
            padding-bottom: 3px;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Summary */
        .summary p {
            font-size: 11px;
            color: #555;
            text-align: justify;
        }

        /* Experience & Education Items */
        .item {
            margin-bottom: 10px;
        }
        .item h3 {
            font-size: 12px;
            color: #2c3e50;
            margin-bottom: 1px;
        }
        .item .meta {
            font-size: 10px;
            color: #7f8c8d;
            margin-bottom: 4px;
        }
        .item .description {
            font-size: 11px;
            color: #555;
            white-space: pre-line;
        }

        /* Skills grid - using table for dompdf compatibility */
        .skills-table {
            width: 100%;
            border-collapse: collapse;
        }
        .skills-table td {
            width: 50%;
            vertical-align: top;
            padding: 0 10px 8px 0;
        }
        .skill-category-name {
            font-size: 11px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 4px;
        }
        .skill-entry {
            font-size: 10px;
            color: #555;
            padding: 1px 0;
        }
        .skill-bar-bg {
            display: inline-block;
            width: 80px;
            height: 6px;
            background: #ecf0f1;
            border-radius: 3px;
            vertical-align: middle;
            margin-left: 5px;
        }
        .skill-bar-fill {
            display: inline-block;
            height: 6px;
            background: #3498db;
            border-radius: 3px;
        }

        /* Projects */
        .project-item {
            margin-bottom: 8px;
        }
        .project-item h3 {
            font-size: 12px;
            color: #2c3e50;
            margin-bottom: 2px;
        }
        .project-item .tech {
            font-size: 10px;
            color: #3498db;
            margin-bottom: 2px;
        }
        .project-item .desc {
            font-size: 10px;
            color: #555;
        }
        .project-item .links {
            font-size: 9px;
            color: #7f8c8d;
            margin-top: 2px;
        }

        /* Footer */
        .footer {
            text-align: center;
            font-size: 9px;
            color: #bdc3c7;
            margin-top: 20px;
            padding-top: 8px;
            border-top: 1px solid #ecf0f1;
        }
    </style>
</head>
<body>

    {{-- HEADER --}}
    <div class="header">
        <h1>{{ $profile->full_name }}</h1>
        <div class="title">{{ $profile->title ?? 'Software Developer' }}</div>
        <div class="contact-line">
            <span>{{ $user->email }}</span>
            @if($profile->phone) | <span>{{ $profile->phone }}</span> @endif
            @if($profile->location) | <span>{{ $profile->location }}</span> @endif
            @if($profile->github) | <span>{{ $profile->github }}</span> @endif
        </div>
    </div>

    {{-- SUMMARY --}}
    @if($profile->bio)
    <div class="section summary">
        <h2>Professional Summary</h2>
        <p>{{ $profile->bio }}</p>
    </div>
    @endif

    {{-- EXPERIENCE --}}
    @if($experiences->count())
    <div class="section">
        <h2>Work Experience</h2>
        @foreach($experiences as $job)
        <div class="item">
            <h3>{{ $job->job_title }}</h3>
            <div class="meta">{{ $job->company_details }}</div>
            @if($job->description)
            <div class="description">{{ $job->description }}</div>
            @endif
        </div>
        @endforeach
    </div>
    @endif

    {{-- EDUCATION --}}
    @if($education->count())
    <div class="section">
        <h2>Education</h2>
        @foreach($education as $edu)
        <div class="item">
            <h3>{{ $edu->degree }}</h3>
            <div class="meta">{{ $edu->school_details }}</div>
            @if($edu->description)
            <div class="description">{{ $edu->description }}</div>
            @endif
        </div>
        @endforeach
    </div>
    @endif

    {{-- SKILLS --}}
    @if($skills->count())
    <div class="section">
        <h2>Technical Skills</h2>
        @php $groupedSkills = $skills->groupBy('category'); @endphp
        <table class="skills-table">
            <tr>
            @foreach($groupedSkills as $category => $skillList)
                <td>
                    <div class="skill-category-name">{{ $category }}</div>
                    @foreach($skillList as $skill)
                    <div class="skill-entry">
                        {{ $skill->name }}
                        <span class="skill-bar-bg">
                            <span class="skill-bar-fill" style="width: {{ $skill->proficiency_level }}%;"></span>
                        </span>
                    </div>
                    @endforeach
                </td>
                @if($loop->iteration % 2 == 0 && !$loop->last)
                    </tr><tr>
                @endif
            @endforeach
            </tr>
        </table>
    </div>
    @endif

    {{-- PROJECTS --}}
    @if($projects->count())
    <div class="section">
        <h2>Projects</h2>
        @foreach($projects as $project)
        <div class="project-item">
            <h3>{{ $project->title }}</h3>
            @if($project->technologies)
            <div class="tech">{{ $project->technologies }}</div>
            @endif
            <div class="desc">{{ $project->description }}</div>
            @if($project->repository_link || $project->live_link)
            <div class="links">
                @if($project->repository_link) GitHub: {{ $project->repository_link }} @endif
                @if($project->repository_link && $project->live_link) | @endif
                @if($project->live_link) Live: {{ $project->live_link }} @endif
            </div>
            @endif
        </div>
        @endforeach
    </div>
    @endif

    <div class="footer">
        Generated on {{ now()->format('F j, Y') }}
    </div>

</body>
</html>
