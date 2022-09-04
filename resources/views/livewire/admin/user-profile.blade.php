<div>
    @push('title')
        {{$title}}
    @endpush
{{--    <x-header title="{{$title}}" icon="fas fa-user"/>--}}
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{asset('defaultAvatar.png')}}" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{$user->name}}</h3>

                            <p class="text-muted text-center">Administrator</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>ID</b>
                                    <a class="float-right">{{$user->id}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>{{__('words.created_at')}}</b>
                                    <a class="float-right">{{($user->created_at)?$user->created_at->format('M d Y'):'No data'}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>{{__('words.updated_at')}}</b>
                                    <a class="float-right">{{($user->updated_at)?$user->updated_at->format('M d Y'):'No data'}}</a>
                                </li>
                            </ul>
                            <a class="btn btn-primary btn-block">
                                <i class="fa fa-check"></i>
                                <b>{{__('words.active')}}</b>
                            </a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <div class="card card-tabs card-primary card-outline">
                                <div class="card-header p-0">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-auto">
                                            <ul class="nav nav-pills ml-auto p-2">
                                                <li class="nav-item">
                                                    <a wire:click="general" style="cursor: pointer;"  class="nav-link
                                                        @if($general == true)
                                                        active
@endif
                                                        ">
                                                        <i class="fas fa-cogs"></i> {{__('words.general')}}
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a wire:click="passwordTab" style="cursor: pointer;" class="nav-link cursor-pointer
                                                        @if($general != true)
                                                        active
@endif
                                                        ">
                                                        <i  class="fa fa-lock"></i> {{__('words.Password')}}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">

                            @if($general == true)
                                <div class="card">
                                    <div class="card-body">
                                        <form  wire:submit.prevent="formSubmit">
                                            <div class="form-group field-usersettingsform-username required">
                                                <label for="usersettingsform-username">{{__('words.fio')}}</label>
                                                <input wire:model.lazy="name" type="text" id="usersettingsform-username" class="form-control"
                                                       name="name" value="{{$name}}" aria-required="true">
                                                <x-jet-input-error for="name" class="text-danger" />
                                            </div>
                                            <div class="form-group field-usersettingsform-phone required">
                                                <label for="usersettingsform-phone">{{__('words.Login')}}</label>
                                                <input wire:model.lazy="email" type="email" id="usersettingsform-phone" class="form-control"
                                                       name="email" value="{{$email}}" aria-required="true">

                                                <x-jet-input-error for="email" class="text-danger" />
                                            </div>
                                            <div class="row">
                                                <div class="col d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{__('words.save')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="overlay d-none" wire:loading.class.remove="d-none">
                                        <i class="fas fa-2x fa-sync-alt loadingIcon"></i>
                                    </div>
                                </div>
                            @else
                                <div class="card">
                                    <div class="card-body">
                                        <form id="w0" wire:submit.prevent="passwordSubmit">
                                            @csrf
                                            <div class="form-group field-usersettingsform-password_old required">
                                                <label for="usersettingsform-password_old">{{__('words.old_password')}}</label>
                                                <input wire:model.lazy="password_old" type="password" id="usersettingsform-password_old"
                                                       class="form-control" name="password_old"
                                                       value="" aria-required="true">
                                                <x-jet-input-error for="password_old" class="text-danger" />
                                            </div>
                                            <div class="form-group field-usersettingsform-password required">
                                                <label for="usersettingsform-password">{{__('words.new_password')}}</label>
                                                <input wire:model.lazy="password" type="password" id="usersettingsform-password"
                                                       class="form-control" name="password" value=""
                                                       aria-required="true">
                                                <x-jet-input-error for="password" class="text-danger" />
                                            </div>
                                            <div class="form-group field-usersettingsform-password_repeat required">
                                                <label for="usersettingsform-password_repeat">{{__('words.confirm_password')}}</label>
                                                <input wire:model.lazy="password_confirmation" type="password" id="usersettingsform-password_repeat"
                                                       class="form-control" name="password_confirmation"
                                                       value="" aria-required="true">
                                                <x-jet-input-error for="password_confirmation" class="text-danger" />
                                            </div>
                                            <div class="row">
                                                <div class="col d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{__('words.save')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="overlay d-none" wire:loading.class.remove="d-none">
                                        <i class="fas fa-2x fa-sync-alt loadingIcon"></i>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    @push('scripts')
        <script>
            Livewire.on('UserDataChanged', () => {
                toastr.success('{{__('words.saved')}}');
            });
        </script>
    @endpush
</div>