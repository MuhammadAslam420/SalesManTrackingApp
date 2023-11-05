<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Route Form</h4>
                    @if(Session::has('message'))
                    <div class="alert alert-success alert-dismissible show fade">
                        {{ Session::get('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" wire:submit.prevent="addRoute">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="route">Route Name</label>
                                        <input type="text" id="route" class="form-control"
                                            placeholder="Full Name" name="route" wire:model='route'>
                                        @error('route')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="salesman_id">Assign Salesman To Route </label>
                                        <select name="salesman_id" id="salesman_id" class="form-control text-dark" wire:model='salesman_id'>
                                           <option value="" >Select Salesman</option>
                                           @foreach ($salesmans as $salesman)
                                           <option value="{{$salesman->id }}" selected>{{$salesman->name}}</option>
                                           @endforeach
                                        </select>

                                        @error('salesman_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control" wire:model='status'>
                                            <option value="default" disabled>Select Status</option>
                                            <option value="active">Active</option>
                                            <option value="inactive">In-Active</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="visit_day">Visit Day</label>
                                        <select name="visit_day" id="visit_day" class="form-control" wire:model='visit_day'>
                                            <option value="default" disabled>Select visit day</option>
                                            <option value="monday">Monday</option>
                                            <option value="tuesday">Tuesday</option>
                                            <option value="wednesday">Wednesday</option>
                                            <option value="thursday">Thursday</option>
                                            <option value="friday">Friday</option>
                                            <option value="saturday">Saturday</option>
                                            <option value="sunday">Sunday</option>

                                        </select>
                                        @error('visit_day')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>