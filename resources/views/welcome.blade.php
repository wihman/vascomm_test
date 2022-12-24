@extends('layouts.layout')

@section('content')
<v-container>
    <v-row>
        <v-col cols="12">
            <v-card class="elevation-0">
                <v-card-text>
                    <template>
                        <v-carousel hide-delimiters class="rounded-lg">
                            <v-carousel-item
                                v-for="(item,i) in databanner"
                                :key="i"
                                :src="item.image.replace('public', '/storage')"
                            ></v-carousel-item>
                        </v-carousel>
                    </template>
                </v-card-text>
            </v-card>
        </v-col>
    </v-row>
    <v-row>
        @foreach($products as $d)
            <v-col cols="12" md="3">
                <v-card class="elevation-0 rounded-lg">
                    <v-card-text>
                        <img class="rounded-lg" src="{{ str_replace('public', '/storage', $d->image) }}" width="100%" alt="">
                    </v-card-text>
                    <v-card-title class="mt-n6">
                        <v-row>
                            <v-col cols="12">
                                <v-icon color="orange">mdi-star</v-icon>
                                <v-icon color="orange">mdi-star</v-icon>
                                <v-icon color="orange">mdi-star</v-icon>
                                <v-icon color="orange">mdi-star</v-icon>
                                <v-icon color="grey">mdi-star</v-icon>
                            </v-col>
                            <v-col cols="12" class="mt-n4">
                                <div class="font-weight-bold" title="{{ $d->name }}">{{ substr($d->name, 0, 20) }}...</div>
                            </v-col>
                            <v-col cols="6" class="mt-n5">
                                <div class="font-weight-light">{{ number_format($d->price) }}</div>
                            </v-col>
                            <v-col cols="6" class="mt-n5">
                                <div class="font-weight-light">Stock: {{ $d->quantity }}</div>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12">
                                <v-btn color="primary" class="white--text text-capitalize" block>
                                    Add to Cart
                                </v-btn>
                            </v-col>
                        </v-row>
                    </v-card-title>
                </v-card>
            </v-col>
        @endforeach
    </v-row>
</v-container>
@endsection

