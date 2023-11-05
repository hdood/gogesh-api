 <?php
 use App\Enum\EnumGeneral;
 ?>
 @extends('layout')
 @section('title', 'sellers')
 @section('active6', 'active')
 @section('menu6', 'block')

 @section('menu6_a1', 'menu-active')

 @section('content')

     <!-- Breadcubs Area Start Here -->
     <div class="breadcrumbs-area">
         <h3>{{ __('Add Seller') }}</h3>
         <ul>
             <li>
                 <a href="{{ route('dashboard') }}">{{ __('home') }}</a>
             </li>
             <li>{{ __('Add Seller') }}</li>
         </ul>
     </div>
     <!-- Breadcubs Area End Here -->
     <!-- Admit Form Area Start Here -->
     <div class="card height-auto" data-select2-id="21">
         <div class="card-body" data-select2-id="20">
             <div class="heading-layout1">
                 <div class="item-title">
                 </div>

             </div>
             <form class="new-added-form" method="post" action="{{ route('seller.store') }}" enctype="multipart/form-data">
                 @csrf
                 <div class="row" data-select2-id="18">

                     <div class="col-md-6 form-group">
                         <label>{{ __('First Name') }} *</label>
                         <input type="text" name="firstname" placeholder="" class="form-control" value="" required>
                         @error('firstname')
                             <span class="text-red">{!! $message !!}</span>
                         @enderror
                     </div>
                     <div class="col-md-6 form-group">
                         <label>{{ __('Last Name') }} *</label>
                         <input type="text" name="lastname" placeholder="" class="form-control" value="" required>
                         @error('lastname')
                             <span class="text-red">{!! $message !!}</span>
                         @enderror
                     </div>
                     <div class="col-md-6 form-group">
                         <label>{{ __('Email') }} *</label>
                         <input autocomplete="off" type="text" name="email" placeholder="" class="form-control"
                             value="" required>
                         @error('email')
                             <span class="text-red">{!! $message !!}</span>
                         @enderror
                     </div>
                     <div class="col-md-6 form-group">
                         <label>{{ __('Phone number') }} *</label>
                         <div class="form-control d-flex align-items-center">
                             <select name="country_code" id=""
                                 style="
                             height: 100%;
                             border: none;
                             background: transparent;
                             outline: none;
                         ">
                                 @foreach ($country_code as $item)
                                     <option value="{{ $item->alpha_2_code . '-' . $item->dial_code }}">
                                         {{ $item->dial_code }}
                                     </option>
                                 @endforeach
                             </select>
                             <input type="text" name="phone" placeholder="Enter Your phone" class="form-control phone"
                                 value="" required>
                             @error('phone')
                                 <span class="text-red">{!! $message !!}</span>
                             @enderror
                         </div>
                     </div>
                     <div class="col-12  form-group">
                         <label>{{ __('gender') }} *</label>
                         <select id="gender" name="gender" class="select2 select2-hidden-accessible" required>
                             <option value="">{{ __('Select') }}</option>
                             <option value="{{ EnumGeneral::MALE }}">{{ __(EnumGeneral::MALE) }}</option>
                             <option value="{{ EnumGeneral::FEMALE }}">{{ __(EnumGeneral::FEMALE) }}</option>
                         </select>
                         @error('gender')
                             <span class="text-red">{!! $message !!}</span>
                         @enderror
                     </div>
                     <div class="col-12  form-group">
                         <label>{{ __('Status') }} *</label>
                         <select id="editstatus" name="status" class="select2 select2-hidden-accessible" required>
                             <option value="">Select</option>
                             <option value="{{ EnumGeneral::ACTIVE }}">
                                 {{ __(EnumGeneral::ACTIVE) }}</option>
                             <option value="{{ EnumGeneral::INACTIVE }}">
                                 {{ __(EnumGeneral::INACTIVE) }}</option>
                         </select>
                         @error('status')
                             <span class="text-red">{!! $message !!}</span>
                         @enderror
                     </div>
                     <div class="col-md-4  form-group">
                         <label>{{ __('Country') }} *</label>
                         <select id="addCountry" name="country_id" class="select2 select2-hidden-accessible">
                             <option value="">Select</option>
                             @foreach ($countries as $item)
                                 <option value="{{ $item->id }}">
                                     @if (app()->getLocale() == 'en')
                                         {{ $item->name_en }}
                                     @else
                                         {{ $item->name_ar }}
                                     @endif
                                 </option>
                             @endforeach
                         </select>
                         @error('country_id')
                             <span class="text-red">{!! $message !!}</span>
                         @enderror
                     </div>
                     <div class="col-md-4  form-group">
                         <label>{{ __('City') }} *</label>
                         <select id="addCity" name="city_id" class="select2 select2-hidden-accessible">

                         </select>
                         @error('city_id')
                             <span class="text-red">{!! $message !!}</span>
                         @enderror
                     </div>
                     <div class="col-md-4  form-group">
                         <label>{{ __('Region') }} *</label>
                         <select id="addRegion" name="region_id" class="select2 select2-hidden-accessible">

                         </select>
                         @error('region_id')
                             <span class="text-red">{!! $message !!}</span>
                         @enderror
                     </div>
                     <div class="col-md-6  form-group">
                         <label>{{ __('Services') }} *</label>
                         <select id="" name="services_id[]" class="select2 select2-hidden-accessible" multiple>
                             <option value="">Select</option>
                             @foreach ($services as $item)
                                 <option value="{{ $item->id }}">
                                     {{ $item->getName() }}
                                 </option>
                             @endforeach
                         </select>
                         @error('services_id')
                             <span class="text-red">{!! $message !!}</span>
                         @enderror
                     </div>
                     <div class="col-md-6  form-group">
                         <label>{{ __('Sections') }} *</label>
                         <select id="" name="sections_id[]" class="select2 select2-hidden-accessible" multiple>
                             @foreach ($sections as $item)
                                 <option value="{{ $item->id }}">
                                     {{ $item->getName() }}
                                 </option>
                             @endforeach
                         </select>
                         @error('sections_id')
                             <span class="text-red">{!! $message !!}</span>
                         @enderror
                     </div>
                     <div class="col-md-6 form-group">
                         <label>{{ __('Password') }} *</label>
                         <input autocomplete="off" type="password" name="password" placeholder="" class="form-control"
                             required>
                         @error('password')
                             <span class="text-red">{!! $message !!}</span>
                         @enderror
                     </div>
                     <div class="col-md-6 form-group">
                         <label>{{ __('Confirme Password') }} *</label>
                         <input autocomplete="off" type="password" name="password_confirmation" placeholder=""
                             class="form-control" required>
                         @error('password_confirmation')
                             <span class="text-red">{!! $message !!}</span>
                         @enderror
                     </div>
                     <div class="col-12 form-group mg-t-8">
                         <button type="submit"
                             class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">{{ __('save') }}</button>
                         <a href="{{ route('customer.index') }}"
                             class="btn-fill-lg bg-blue-dark btn-hover-yellow">{{ __('cancel') }}</a>
                     </div>
                 </div>

             </form>
         </div>
     </div>



 @endsection
 @section('script')
     <script>
         new Cleave('.phone', {
             numeral: true,
             numeralPositiveOnly: true,
             delimiter: '',
             numeralIntegerScale: 15,
             stripLeadingZeroes: false,
             numeralThousandsGroupStyle: 'lakh'
         });
     </script>
 @endsection
