package info.androidhive.capstoneproj.splash;

/**
 * Created by Babyyy on 6/26/2015.
 */

import android.app.Activity;
import android.app.ActivityManager;
import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.ProgressBar;

import info.androidhive.capstoneproj.CatalogActivity;
import info.androidhive.capstoneproj.MainActivity;
import info.androidhive.capstoneproj.R;
import info.androidhive.capstoneproj.connection.ConnectionDetector;
import info.androidhive.capstoneproj.connection.NoInternetActivity;
import info.androidhive.capstoneproj.session.SessionManager;


public class SplashActivity extends Activity implements LoadingTask.LoadingTaskFinishedListener {
    Boolean isInternetPresent = false;
    ConnectionDetector cd;
    SessionManager session;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        // Show the splash screen
        setContentView(R.layout.activity_splash);
        session = new SessionManager(getApplicationContext());
        cd = new ConnectionDetector(getApplicationContext());
        isInternetPresent = cd.isConnectingToInternet();
        if (!isInternetPresent) {
            Intent intent = new Intent(SplashActivity.this, NoInternetActivity.class);
            startActivity(intent);
            finish();
            return;
        }
        if (session.isLoggedIn()) {
            Intent intent = new Intent(SplashActivity.this, CatalogActivity.class);
            startActivity(intent);
            finish();
            return;
        }

        // Find the progress bar
        ProgressBar progressBar = (ProgressBar) findViewById(R.id.activity_splash_progress_bar);
        // Start your loading
        new LoadingTask(progressBar, this).execute("");
    }

    // This is the callback for when your async task has finished
    @Override
    public void onTaskFinished() {
        completeSplash();
    }

    private void completeSplash() {
        startApp();
        finish(); // Don't forget to finish this Splash Activity so the user can't return to it!
    }

    private void startApp() {
        Intent intent = new Intent(getApplicationContext(), MainActivity.class);
        startActivity(intent);
        finish();
    }

}