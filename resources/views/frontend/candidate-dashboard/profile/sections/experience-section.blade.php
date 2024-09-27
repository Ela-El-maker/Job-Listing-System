<div class="tab-pane fade show " id="pills-experience" role="tabpanel" aria-labelledby="pills-experience-tab">
    <div class="d-flex justify-content-between">
        <h4>Experience</h4>

        <button class="btn btn-primary" onclick="$('#ExperienceForm').trigger('reset'); editId = ''; editMode = false" data-bs-toggle="modal" data-bs-target="#experienceModal">Add Experience</button>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Company</th>
                <th>Department</th>
                <th>Designation</th>
                <th>Period</th>
                <th style="width:25%">Action</th>
            </tr>
        </thead>
        <tbody class="experience-tbody">
            @foreach ($candidateExperiences as $experience)

            <tr>
                <td>{{ $experience?->company }}</td>
                <td>{{ $experience?->department }}</td>
                <td>{{ $experience?->designation }}</td>
                <td>{{ $experience?->start }} - {{ $experience?->currently_working === 1 ? 'Current' : $experience?->end }}</td>
                <td>
                    <a href="{{ route('candidate.experience.edit',$experience->id) }}" class="btn-small btn btn-primary edit-experience" data-bs-toggle="modal"
                        data-bs-target="#experienceModal">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="{{ route('candidate.experience.destroy',$experience->id) }}" class="btn-small btn btn-danger delete-experience">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
