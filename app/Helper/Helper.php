<?php

namespace App\Helper;

use Illuminate\Support\Str;

class Helper {
    // Upload Image
    public static function fileUpload( $file, $folder, $name ) {
        $imageName = Str::slug( $name ) . '.' . $file->extension();
        $file->move( public_path( 'uploads/' . $folder ), $imageName );
        $path = 'uploads/' . $folder . '/' . $imageName;
        return $path;
    }

    //override or add env file or key
    public static function overWriteEnvFile( $type, $val ) {
        $path = base_path( '.env' ); // get file ENV path
        if ( file_exists( $path ) ) {
            $val = '"' . trim( $val ) . '"';
            if ( is_numeric( strpos( file_get_contents( $path ), $type ) ) && strpos( file_get_contents( $path ), $type ) >= 0 ) {
                file_put_contents( $path, str_replace( $type . '="' . env( $type ) . '"', $type . '=' . $val, file_get_contents( $path ) ) );
            } else {
                file_put_contents( $path, file_get_contents( $path ) . "\r\n" . $type . '=' . $val );
            }
        }
    }
    public static function addDurationsArray( array $durations ): string {
        // Initialize variables to store the total duration
        $totalHours = 0;
        $totalMinutes = 0;
        $totalSeconds = 0;

        // Loop through each duration
        foreach ( $durations as $duration ) {
            // Split the input into hours, minutes, and seconds
            list( $hours, $minutes, $seconds ) = explode( ':', $duration );

            // Add the current duration to the totals
            $totalHours += (int) $hours;
            $totalMinutes += (int) $minutes;
            $totalSeconds += (int) $seconds;
        }

        // Convert excess minutes and seconds
        $totalMinutes += floor( $totalSeconds / 60 );
        $totalSeconds %= 60;
        $totalHours += floor( $totalMinutes / 60 );
        $totalMinutes %= 60;

        // Format the total duration as HH:MM:SS
        $totalDuration = sprintf( '%02d:%02d:%02d', $totalHours, $totalMinutes, $totalSeconds );

        return $totalDuration;
    }
    public static function subtractDuration( $duration1, $duration2 ) {
        // Splitting durations into hours, minutes, and seconds
        list( $h1, $m1, $s1 ) = array_map( 'intval', explode( ':', $duration1 ) );
        list( $h2, $m2, $s2 ) = array_map( 'intval', explode( ':', $duration2 ) );

        // Converting everything to seconds
        $totalSeconds1 = $h1 * 3600 + $m1 * 60 + $s1;
        $totalSeconds2 = $h2 * 3600 + $m2 * 60 + $s2;

        // Subtracting the second duration from the first duration
        $resultInSeconds = $totalSeconds1 - $totalSeconds2;

        // Calculating hours, minutes, and seconds from the result
        $resultHours = floor( $resultInSeconds / 3600 );
        $resultMinutes = floor(  ( $resultInSeconds % 3600 ) / 60 );
        $resultSeconds = $resultInSeconds % 60;

        // Formatting the result
        $result = sprintf( '%02d:%02d:%02d', $resultHours, $resultMinutes, $resultSeconds );

        return $result;
    }

    // Make Slug
    public static function MakeSlug( $title, $modal ) {
        $slug = $modal::where( 'slug', Str::slug( $title ) )->first();
        if ( $slug ) {
            $randomString = Str::random( 5 );
            $slug = Str::slug( $title ) . $randomString;
        } else {
            $slug = Str::slug( $title );
        }

        return $slug;
    }

}
