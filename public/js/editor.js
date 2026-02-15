/**
 * Resume Editor — Dashboard CRUD Operations
 *
 * Handles all AJAX calls for Skills, Experience, Education, and Projects
 * on the /profile/edit page.
 */

const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// ─── Helpers ─────────────────────────────────────────────────────

function jsonHeaders() {
    return {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
        'Accept': 'application/json',
    };
}

function handleJsonError(action, error) {
    console.error(`Error ${action}:`, error);
    alert(`Error ${action}. Please try again.`);
}

// ─── SKILL Functions ─────────────────────────────────────────────

function showAddForm(category) {
    const slug = category.toLowerCase().replace(/\s+/g, '-').replace(/&/g, '');
    document.getElementById('add-form-' + slug).style.display = 'block';
}

function cancelAdd(category) {
    const slug = category.toLowerCase().replace(/\s+/g, '-').replace(/&/g, '');
    const form = document.getElementById('add-form-' + slug);
    form.style.display = 'none';
    form.querySelector('.new-skill-name').value = '';
    form.querySelector('.new-skill-level').value = '75';
}

function addSkill(category) {
    const slug = category.toLowerCase().replace(/\s+/g, '-').replace(/&/g, '');
    const form = document.getElementById('add-form-' + slug);
    const name = form.querySelector('.new-skill-name').value.trim();
    const level = form.querySelector('.new-skill-level').value;

    if (!name) {
        alert('Please enter a skill name');
        return;
    }

    fetch('/skills', {
        method: 'POST',
        headers: jsonHeaders(),
        body: JSON.stringify({ name, category, proficiency_level: level }),
    })
        .then((r) => r.json())
        .then((data) => {
            if (data.success) location.reload();
            else alert('Error adding skill: ' + (data.message || 'Unknown error'));
        })
        .catch((e) => handleJsonError('adding skill', e));
}

function editSkill(skillId) {
    const item = document.querySelector(`[data-skill-id="${skillId}"]`);
    item.querySelector('.skill-display').style.display = 'none';
    item.querySelector('.skill-actions').style.display = 'none';
    item.querySelector('.skill-edit-form').style.display = 'block';
}

function cancelEdit(skillId) {
    const item = document.querySelector(`[data-skill-id="${skillId}"]`);
    item.querySelector('.skill-display').style.display = 'block';
    item.querySelector('.skill-actions').style.display = 'block';
    item.querySelector('.skill-edit-form').style.display = 'none';
}

function saveSkill(skillId) {
    const item = document.querySelector(`[data-skill-id="${skillId}"]`);
    const name = item.querySelector('.edit-skill-name').value.trim();
    const level = item.querySelector('.edit-skill-level').value;

    if (!name) {
        alert('Please enter a skill name');
        return;
    }

    fetch(`/skills/${skillId}`, {
        method: 'PUT',
        headers: jsonHeaders(),
        body: JSON.stringify({ name, proficiency_level: level }),
    })
        .then((r) => r.json())
        .then((data) => {
            if (data.success) location.reload();
            else alert('Error updating skill: ' + (data.message || 'Unknown error'));
        })
        .catch((e) => handleJsonError('updating skill', e));
}

function deleteSkill(skillId, skillName) {
    if (!confirm(`Are you sure you want to delete "${skillName}"?`)) return;

    fetch(`/skills/${skillId}`, {
        method: 'DELETE',
        headers: jsonHeaders(),
    })
        .then((r) => r.json())
        .then((data) => {
            if (data.success) location.reload();
            else alert('Error deleting skill: ' + (data.message || 'Unknown error'));
        })
        .catch((e) => handleJsonError('deleting skill', e));
}

// ─── EXPERIENCE Functions ────────────────────────────────────────

function showAddExperienceForm() {
    document.getElementById('add-experience-form').style.display = 'block';
}

function cancelAddExperience() {
    document.getElementById('add-experience-form').style.display = 'none';
    document.getElementById('new-exp-title').value = '';
    document.getElementById('new-exp-company').value = '';
    document.getElementById('new-exp-description').value = '';
}

function addExperience() {
    const title = document.getElementById('new-exp-title').value.trim();
    const company = document.getElementById('new-exp-company').value.trim();
    const description = document.getElementById('new-exp-description').value.trim();

    if (!title || !company) {
        alert('Please fill in job title and company details');
        return;
    }

    fetch('/experiences', {
        method: 'POST',
        headers: jsonHeaders(),
        body: JSON.stringify({ job_title: title, company_details: company, description }),
    })
        .then((r) => r.json())
        .then((data) => {
            if (data.success) location.reload();
            else alert('Error adding experience: ' + (data.message || 'Unknown error'));
        })
        .catch((e) => handleJsonError('adding experience', e));
}

function editExperience(expId) {
    const item = document.querySelector(`[data-exp-id="${expId}"]`);
    item.querySelector('.exp-display').style.display = 'none';
    item.querySelector('.exp-edit-form').style.display = 'block';
}

function cancelEditExperience(expId) {
    const item = document.querySelector(`[data-exp-id="${expId}"]`);
    item.querySelector('.exp-display').style.display = 'block';
    item.querySelector('.exp-edit-form').style.display = 'none';
}

function saveExperience(expId) {
    const item = document.querySelector(`[data-exp-id="${expId}"]`);
    const title = item.querySelector('.edit-exp-title').value.trim();
    const company = item.querySelector('.edit-exp-company').value.trim();
    const description = item.querySelector('.edit-exp-description').value.trim();

    if (!title || !company) {
        alert('Please fill in job title and company details');
        return;
    }

    fetch(`/experiences/${expId}`, {
        method: 'PUT',
        headers: jsonHeaders(),
        body: JSON.stringify({ job_title: title, company_details: company, description }),
    })
        .then((r) => r.json())
        .then((data) => {
            if (data.success) location.reload();
            else alert('Error updating experience: ' + (data.message || 'Unknown error'));
        })
        .catch((e) => handleJsonError('updating experience', e));
}

function deleteExperience(expId, jobTitle) {
    if (!confirm(`Are you sure you want to delete "${jobTitle}"?`)) return;

    fetch(`/experiences/${expId}`, {
        method: 'DELETE',
        headers: jsonHeaders(),
    })
        .then((r) => r.json())
        .then((data) => {
            if (data.success) location.reload();
            else alert('Error deleting experience: ' + (data.message || 'Unknown error'));
        })
        .catch((e) => handleJsonError('deleting experience', e));
}

// ─── EDUCATION Functions ─────────────────────────────────────────

function editEducation(eduId) {
    const item = document.querySelector(`[data-edu-id="${eduId}"]`);
    item.querySelector('.edu-display').style.display = 'none';
    item.querySelector('.edu-edit-form').style.display = 'block';
}

function cancelEditEducation(eduId) {
    const item = document.querySelector(`[data-edu-id="${eduId}"]`);
    item.querySelector('.edu-display').style.display = 'block';
    item.querySelector('.edu-edit-form').style.display = 'none';
}

function saveEducation(eduId) {
    const item = document.querySelector(`[data-edu-id="${eduId}"]`);
    const degree = item.querySelector('.edit-edu-degree').value.trim();
    const details = item.querySelector('.edit-edu-details').value.trim();
    const description = item.querySelector('.edit-edu-description').value.trim();

    if (!degree || !details) {
        alert('Please fill in degree and school details');
        return;
    }

    fetch(`/education/${eduId}`, {
        method: 'PUT',
        headers: jsonHeaders(),
        body: JSON.stringify({ degree, school_details: details, description }),
    })
        .then((r) => r.json())
        .then((data) => {
            if (data.success) location.reload();
            else alert('Error updating education: ' + (data.message || 'Unknown error'));
        })
        .catch((e) => handleJsonError('updating education', e));
}

// ─── PROJECT Functions ───────────────────────────────────────────

function showAddProjectForm() {
    document.getElementById('add-project-form').style.display = 'block';
}

function cancelAddProject() {
    const form = document.getElementById('add-project-form');
    form.style.display = 'none';
    form.querySelectorAll('input[type="text"], input[type="url"], input[type="date"], textarea').forEach((el) => (el.value = ''));
    const cb = form.querySelector('input[type="checkbox"]');
    if (cb) cb.checked = false;
}

function addProject() {
    const title = document.getElementById('new-project-title').value.trim();
    const description = document.getElementById('new-project-description').value.trim();
    const technologies = document.getElementById('new-project-technologies').value.trim();
    const repo = document.getElementById('new-project-repo').value.trim();
    const live = document.getElementById('new-project-live').value.trim();
    const start = document.getElementById('new-project-start').value;
    const end = document.getElementById('new-project-end').value;
    const featured = document.getElementById('new-project-featured').checked;

    if (!title) {
        alert('Please enter a project title');
        return;
    }

    fetch('/projects', {
        method: 'POST',
        headers: jsonHeaders(),
        body: JSON.stringify({
            title,
            description,
            technologies,
            repository_link: repo || null,
            live_link: live || null,
            start_date: start || null,
            end_date: end || null,
            is_featured: featured,
        }),
    })
        .then((r) => r.json())
        .then((data) => {
            if (data.success) location.reload();
            else alert('Error adding project: ' + (data.message || 'Unknown error'));
        })
        .catch((e) => handleJsonError('adding project', e));
}

function editProject(projectId) {
    const item = document.querySelector(`[data-project-id="${projectId}"]`);
    item.querySelector('.project-display').style.display = 'none';
    item.querySelector('.project-edit-form').style.display = 'block';
}

function cancelEditProject(projectId) {
    const item = document.querySelector(`[data-project-id="${projectId}"]`);
    item.querySelector('.project-display').style.display = 'block';
    item.querySelector('.project-edit-form').style.display = 'none';
}

function saveProject(projectId) {
    const item = document.querySelector(`[data-project-id="${projectId}"]`);
    const title = item.querySelector('.edit-project-title').value.trim();
    const description = item.querySelector('.edit-project-description').value.trim();
    const technologies = item.querySelector('.edit-project-technologies').value.trim();
    const repo = item.querySelector('.edit-project-repo').value.trim();
    const live = item.querySelector('.edit-project-live').value.trim();
    const start = item.querySelector('.edit-project-start').value;
    const end = item.querySelector('.edit-project-end').value;
    const featured = item.querySelector('.edit-project-featured').checked;

    if (!title) {
        alert('Please enter a project title');
        return;
    }

    fetch(`/projects/${projectId}`, {
        method: 'PUT',
        headers: jsonHeaders(),
        body: JSON.stringify({
            title,
            description,
            technologies,
            repository_link: repo || null,
            live_link: live || null,
            start_date: start || null,
            end_date: end || null,
            is_featured: featured,
        }),
    })
        .then((r) => r.json())
        .then((data) => {
            if (data.success) location.reload();
            else alert('Error updating project: ' + (data.message || 'Unknown error'));
        })
        .catch((e) => handleJsonError('updating project', e));
}

function deleteProject(projectId, projectTitle) {
    if (!confirm(`Are you sure you want to delete "${projectTitle}"?`)) return;

    fetch(`/projects/${projectId}`, {
        method: 'DELETE',
        headers: jsonHeaders(),
    })
        .then((r) => r.json())
        .then((data) => {
            if (data.success) location.reload();
            else alert('Error deleting project: ' + (data.message || 'Unknown error'));
        })
        .catch((e) => handleJsonError('deleting project', e));
}

// ─── Unsaved Changes Warning ─────────────────────────────────────

let formChanged = false;

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('input, textarea').forEach((el) => {
        el.addEventListener('change', () => { formChanged = true; });
    });

    const mainForm = document.querySelector('form');
    if (mainForm) {
        mainForm.addEventListener('submit', () => { formChanged = false; });
    }
});

window.addEventListener('beforeunload', (e) => {
    if (formChanged) {
        e.preventDefault();
        e.returnValue = 'You have unsaved changes. Are you sure you want to leave?';
    }
});
