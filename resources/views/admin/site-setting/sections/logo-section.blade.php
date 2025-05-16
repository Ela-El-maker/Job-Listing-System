 <div class="tab-pane fade" id="profile4" role="tabpanel" aria-labelledby="profile-tab4">
     <form action="{{ route('admin.logo-settings.update') }}" method="post" enctype="multipart/form-data">
         @csrf
         <div class="row">
             {{-- Logo Preview + Input --}}
             <div class="col-md-6">
                 <div class="mb-2">
                     <label for="logo">Current Logo</label>
                     <x-image-preview :height="100" :width="200" :source="config('settings.site_logo')" />
                 </div>
                 <div class="form-group">
                     <label for="logo">Upload Logo</label>
                     <input type="file" class="form-control-file {{ hasError($errors, 'logo') }}" name="logo">
                     <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                 </div>
             </div>

             {{-- Background Footer Preview + Input --}}
             <div class="col-md-6">
                 <div class="mb-2">
                     <label for="favicon">Current Favicon</label>
                     <x-image-preview :height="100" :width="200" :source="config('settings.site_favicon')" />
                 </div>
                 <div class="form-group">
                     <label for="favicon">Upload Favicon</label>
                     <input type="file" class="form-control-file {{ hasError($errors, 'favicon') }}"
                         name="favicon">
                     <x-input-error :messages="$errors->get('favicon')" class="mt-2" />
                 </div>
             </div>

         </div>

         <div class="form-group">
             <button type="submit" class="btn btn-primary"> Update</button>
         </div>
     </form>


 </div>
