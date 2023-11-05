<div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-5">
                        Create or Update Setting
                    </div>
                    <div class="col-md-4">
                        @if (Session::has('message'))
                            <div class="alert alert-success alert-dismissible show fade">
                                {{ Session::get('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @elseif(Session::has('error'))
                            <div class="alert alert-danger alert-dismissible show fade">
                                {{ Session::get('error') }}.
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                   
                </div>
            </div>
            <div class="card-body">
                <form   wire:submit.prevent="addSetting" enctype="multipart/form-data">
                   
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="label-control">Application Name</label>
                                <input type="text" id="name" class="form-control rounded-lg border border-light" name="name" wire:model='name'>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                    
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="google_api" class="label-control">Google Map Api Key</label>
                                <input type="text" id="google_api" class="form-control rounded-lg border border-light" name="google_api" wire:model='google_api'>
                                @error('google_api')
                                <span class="text-danger">{{ $message }}</span>
                                    
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="copy_write" class="label-control">Copy Right</label>
                                <input type="text" id="copy_write" class="form-control rounded-lg border border-light" name="copy_write" wire:model='copy_write'>
                                @error('copy_write')
                                <span class="text-danger">{{ $message }}</span>
                                    
                                @enderror
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

