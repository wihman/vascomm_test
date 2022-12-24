@extends('layouts.layout')

@section('content')
<v-container>
    <v-row>
        <v-col cols="12">
            <v-card class="elevation-0">
                <v-card-text>
                    <h3>Profile</h3>
                    <p>Detail profile customer</p>
                    <v-divider></v-divider>
                    @foreach($user as $c)
                    <div class="row">
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            <img src="{{ str_replace('public', '/storage', $c->selfie) }}" alt="" srcset="" height="200px" class="rounded-lg">
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            Name :
                            <p class="text-h4 ml-5 text-uppercase font-weight-black black--text">{{ $c->name }}</p>
                            Email :
                            <p class="text-h6 ml-5">{{ $c->email }}</p>
                            Alamat :
                            <p class="text-h6 ml-5">{{ $c->alamat }}</p>
                        </div>
                    </div>
                    @endforeach
                </v-card-text>
            </v-card>
        </v-col>
    </v-row>

</v-container>
@endsection

