package info.androidhive.capstoneproj.connection;

import android.app.Activity;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;

import info.androidhive.capstoneproj.CatalogActivity;
import info.androidhive.capstoneproj.MainActivity;
import info.androidhive.capstoneproj.R;
import info.androidhive.capstoneproj.session.SessionManager;


/**
 * Created by Babyyy on 7/1/2015.
 */
public class NoInternetActivity extends Activity {
    // Refresh menu item
    MenuItem refreshMenuItem;
    Boolean isInternetPresent = false;
    ConnectionDetector cd;
    SessionManager session;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.noconnection);
        setTitle("No Internet Connection");

        session = new SessionManager(getApplicationContext());
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu3, menu);
        return true;
    }

    /**
     * Async task to load the data from server
     **/
    private class SyncData extends AsyncTask<String, Void, String> {
        @Override
        protected void onPreExecute() {
            // set the progress bar view
            refreshMenuItem.setActionView(R.layout.action_progressbar);

            refreshMenuItem.expandActionView();
        }

        @Override
        protected String doInBackground(String... params) {
            // not making real request in this demo
            // for now we use a timer to wait for sometime

            cd = new ConnectionDetector(getApplicationContext());
            isInternetPresent = cd.isConnectingToInternet();
            if (!isInternetPresent) {
            } else {
                if (session.isLoggedIn()) {
                    Intent intent = new Intent(NoInternetActivity.this, CatalogActivity.class);
                    startActivity(intent);
                    finish();
                } else {
                    Intent intent = new Intent(NoInternetActivity.this, MainActivity.class);
                    startActivity(intent);
                    finish();
                }
            }
            try {
                Thread.sleep(3000);
            } catch (InterruptedException e) {
                e.printStackTrace();
            }
            return null;
        }

        @Override
        protected void onPostExecute(String result) {
            refreshMenuItem.collapseActionView();
            // remove the progress bar view
            refreshMenuItem.setActionView(null);
        }
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();
        if (id == R.id.refresh) {
            // refresh
            refreshMenuItem = item;
            // load the data from server
            new SyncData().execute();
            return true;
        }
        //noinspection SimplifiableIfStatement

        return super.onOptionsItemSelected(item);
    }
}
