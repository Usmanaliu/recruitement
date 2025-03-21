<?= $this->extend('templates/base') ?>


<?= $this->section('content') ?>
<div class="container">
    <h2>Experience Information</h2>
    
    <?= form_open('/experienceSave', ['method' => 'post', 'id' => 'exp_form']) ?>
    <?= csrf_field() ?>

    <input type="hidden" name="application_id" value="<?= $application_id ?>">

    <!-- Experience Section -->
    <div class="form-group">
        <label>
            <?= form_checkbox('isExperience', 1, old('isExperience') ?? 0, ['id' => 'isExperience', 'onchange' => 'toggleExperienceFields()']) ?>
            Do you have work experience?
        </label>
    </div>

    <div id="experienceFields" style="display: none;">
        <div class="form-group">
            <label>Job Experience</label>
            <?= form_textarea([
                'name' => 'job_experience',
                'class' => 'form-control',
                'value' => old('job_experience'),
                'rows' => 4
            ]) ?>
        </div>

        <div class="form-group">
            <label>NOC Number</label>
            <?= form_input([
                'type' => 'text',
                'name' => 'noc_number',
                'class' => 'form-control',
                'value' => old('noc_number')
            ]) ?>
        </div>
    </div>

    <!-- Army Section -->
    <div class="form-group">
        <label>
            <?= form_checkbox('ex_army', 1, old('ex_army') ?? 0, ['id' => 'ex_army', 'onchange' => 'toggleArmyFields()']) ?>
            Are you ex-army?
        </label>
    </div>
    
    <div id="armyFields" style="display: none;">
    <div class="form-group">
            <label>Army joing Date</label>
            <?= form_input([
                'type' => 'date',
                'name' => 'army_joining_date',
                'class' => 'form-control',
                'value' => old('earmy_joining_date')
            ]) ?>
        </div>

        <div class="form-group">
            <label>Discharge Certificate Number</label>
            <?= form_input([
                'type' => 'text',
                'name' => 'ex_army_discharge_certificate_number',
                'class' => 'form-control',
                'value' => old('ex_army_discharge_certificate_number')
            ]) ?>
        </div>

        <div class="form-group">
            <label>Discharge Certificate Date</label>
            <?= form_input([
                'type' => 'date',
                'name' => 'ex_army_discharge_certificate_date',
                'class' => 'form-control',
                'value' => old('ex_army_discharge_certificate_date')
            ]) ?>
        </div>
    </div>
    <div class="btn_submit">
        <div class="m-auto w-25">
        <a class="btn btn-outline-secondary me-5" href="<?= base_url('/application-page?application_id='.$application_id) ?>">Cancel</a>
        <button id='submit-btn'  type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
    <?= form_close() ?>
</div>

<script>
    function toggleExperienceFields() {
        const experienceCheckbox = document.getElementById('isExperience');
        const experienceFields = document.getElementById('experienceFields');
        experienceFields.style.display = experienceCheckbox.checked ? 'block' : 'none';
    }

    function toggleArmyFields() {
        const armyCheckbox = document.getElementById('ex_army');
        const armyFields = document.getElementById('armyFields');
        armyFields.style.display = armyCheckbox.checked ? 'block' : 'none';
    }

    // Initialize fields on page load
    window.onload = function() {
        toggleExperienceFields();
        toggleArmyFields();
    };

    document.getElementById('exp_form').addEventListener('submit', function(e) {
        const btn = this.querySelector('#submit-btn');
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status"></span> Adding...';
    });

</script>
<?= $this->endSection() ?>