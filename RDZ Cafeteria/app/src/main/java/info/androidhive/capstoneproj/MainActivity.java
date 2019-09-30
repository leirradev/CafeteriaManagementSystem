package info.androidhive.capstoneproj;

import info.androidhive.capstoneproj.connection.ConnectionDetector;
import info.androidhive.capstoneproj.connection.NoInternetActivity;
import info.androidhive.capstoneproj.controller.AppController;
import info.androidhive.capstoneproj.ip.IpAddress;
import info.androidhive.capstoneproj.session.SessionManager;

import android.app.Activity;
import android.app.AlertDialog;
import android.app.Dialog;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.res.TypedArray;
import android.os.Bundle;
import android.support.v4.app.ActionBarDrawerToggle;
import android.support.v4.widget.DrawerLayout;
import android.telephony.SmsManager;
import android.telephony.TelephonyManager;
import android.util.Log;
import android.view.View;
import android.view.Window;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.VolleyLog;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.JsonObjectRequest;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class MainActivity extends Activity {
    DrawerLayout mDrawerLayout;
    ListView mDrawerList;
    ActionBarDrawerToggle mDrawerToggle;

    // nav drawer title
    CharSequence mDrawerTitle;

    // used to store app title
    CharSequence mTitle;

    // slide menu items
    String[] navMenuTitles;
    TypedArray navMenuIcons;

    ProgressDialog pDialog;
    Context context = this;
    String jsonResponse;
    String TAG = MainActivity.class.getSimpleName();
    String _id, _image, un, pw, user1, _statuses, update_url;
    EditText user, pass;
    Button login;
    JSONObject jsonObject;

    String URL;
    int temp1 = 0, counter = 0;
    Boolean isInternetPresent = false;
    ConnectionDetector cd;
    SessionManager session;
    TextView forgotpass;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        pDialog = new ProgressDialog(context);
        pDialog.setMessage("Loading...");
        pDialog.setCancelable(false);

        session = new SessionManager(getApplicationContext());
        cd = new ConnectionDetector(getApplicationContext());
        isInternetPresent = cd.isConnectingToInternet();
        if (!isInternetPresent) {
            Intent intent = new Intent(MainActivity.this, NoInternetActivity.class);
            startActivity(intent);
            finish();
        }

        user = (EditText) findViewById(R.id.user);
        pass = (EditText) findViewById(R.id.pass);
        login = (Button) findViewById(R.id.login);
        forgotpass = (TextView) findViewById(R.id.forgotpass);
        forgotpass.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                showDialog();
                final Dialog dialog = new Dialog(MainActivity.this);
                dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
                dialog.setContentView(R.layout.forgotpassword);
                //dialog.setTitle("Retrieving password");

                final TextView userr = (TextView) dialog.findViewById(R.id.userr);
                final Button submit = (Button) dialog.findViewById(R.id.submit);
                submit.setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        String ha = userr.getText().toString();
                        if (ha.isEmpty()) {
                            hideDialog();
                            showAlertDialog(MainActivity.this, "Forgot Password",
                                    "Please enter a valid username.", false);
                            user.requestFocus();
                            return;
                        }///////////////////////////////////////////////////////////////////////////////////////////////////////////
                        IpAddress haha = new IpAddress();
                        haha.getLocalIpAddress();
                        String URL = "http://192.168.1.172/capstone/JSONUSER.php";
                        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(URL,
                                new Response.Listener<JSONArray>() {
                                    @Override
                                    public void onResponse(final JSONArray jsonArray) {
                                        jsonResponse = "";
                                        Log.d(TAG, jsonArray.toString());
                                        try {
                                            String temp = "";
                                            for (int i = 0; i < jsonArray.length(); i++) {
                                                jsonObject = jsonArray.getJSONObject(i);
                                                _id = jsonObject.getString("_username");
                                                _image = jsonObject.getString("_password");
                                                _statuses = jsonObject.getString("_status");
                                                final String numbers = jsonObject.getString("_contact_no");
                                                String getuser = userr.getText().toString();
                                                temp1 = 0;
                                                if (getuser.equals(_id) && _statuses.equals("ACTIVE")) {
                                                    temp1++;
                                                    hideDialog();
                                                    final SmsManager sms = SmsManager.getDefault();
                                                    String retpass = _image;
                                                    TelephonyManager tm = (TelephonyManager) getSystemService(TELEPHONY_SERVICE);
                                                    String number = tm.getLine1Number();
                                                    String msg = "Retrieved password\nYour password is: " + retpass;
                                                    sms.sendTextMessage(numbers, null, msg, null, null);
                                                    hideDialog();
                                                    dialog.dismiss();
                                                    showAlertDialog(MainActivity.this, "Forgot Password",
                                                            "Your password will be sent to your mobile number. Please wait.", true);
                                                    break;
                                                }
                                                if (getuser.isEmpty()) {
                                                    hideDialog();
                                                    showAlertDialog(MainActivity.this, "Forgot Password",
                                                            "Please enter a valid username.", false);
                                                    temp1++;
                                                    userr.requestFocus();
                                                    break;
                                                }
                                            }
                                            if (temp1 == 0) {
                                                hideDialog();
                                                showAlertDialog(MainActivity.this, "Log In",
                                                        "Username was not found!", false);
                                                userr.setText("");
                                                userr.requestFocus();
                                            }
                                        } catch (Exception e) {
                                            e.printStackTrace();
                                        }
                                    }
                                },
                                new Response.ErrorListener() {
                                    @Override
                                    public void onErrorResponse(VolleyError volleyError) {
                                        //Toast.makeText(getApplicationContext(), volleyError.getMessage(), Toast.LENGTH_SHORT).show();
                                    }
                                }
                        );
                        AppController.getInstance().addToRequestQueue(jsonArrayRequest);
                        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                    }
                });
hideDialog();
                /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                dialog.show();
            }
        });

        login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                JSONUSER();
            }
        });
        mTitle = "Student Log In";
        getActionBar().setTitle(mTitle);
    }

    public void showAlertDialog(Context context, String title, String message, Boolean status) {
        AlertDialog alertDialog = new AlertDialog.Builder(context).create();
        alertDialog.setTitle(title);
        alertDialog.setMessage(message);
        alertDialog.setIcon((status) ? R.drawable.success : R.drawable.fail);
        alertDialog.setButton("OK", new DialogInterface.OnClickListener() {
            public void onClick(DialogInterface dialog, int which) {

            }
        });
        alertDialog.show();
    }

    public void showDialog() {
        if (!pDialog.isShowing()) {
            pDialog.show();
        }
    }

    public void hideDialog() {
        if (pDialog.isShowing()) {
            pDialog.dismiss();
        }
    }

    public void JSONBlockUser() {
        user1 = user.getText().toString();
        IpAddress haha = new IpAddress();
        haha.getLocalIpAddress();
        update_url = "http://192.168.1.172/capstone/JSONBlocked.php?_username=" + user1;
        JsonObjectRequest update_request = new JsonObjectRequest(update_url,
                null, new Response.Listener<JSONObject>() {
            @Override
            public void onResponse(JSONObject response) {
                try {
                    int success = response.getInt("success");
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                VolleyLog.d(TAG, error.getMessage());
            }
        });
        // Adding request to request queue
        AppController.getInstance().addToRequestQueue(update_request);
    }

    public void JSONUSER() {
        showDialog();
        isInternetPresent = cd.isConnectingToInternet();
        if (!isInternetPresent) {
            hideDialog();
            Intent intent = new Intent(MainActivity.this, NoInternetActivity.class);
            startActivity(intent);
            finish();
        } else {
            String URL = "http://192.168.1.172/capstone/JSONUSER.php";
            JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(URL,
                    new Response.Listener<JSONArray>() {
                        @Override
                        public void onResponse(final JSONArray jsonArray) {
                            jsonResponse = "";
                            Log.d(TAG, jsonArray.toString());
                            try {
                                String temp = "";
                                for (int i = 0; i < jsonArray.length(); i++) {
                                    jsonObject = jsonArray.getJSONObject(i);
                                    _id = jsonObject.getString("_username");
                                    _statuses = jsonObject.getString("_status");
                                    _image = jsonObject.getString("_password");
                                    un = user.getText().toString();
                                    pw = pass.getText().toString();
                                    temp1 = 0;
                                    if (un.equals(_id) && pw.equals(_image) && _statuses.equals("ACTIVE")) {
                                        temp1++;
                                        hideDialog();
                                        session.createLoginSession(_id, _image);
                                        Intent intent = new Intent(MainActivity.this, CatalogActivity.class);
                                        startActivity(intent);
                                        finish();
                                        break;
                                    }
                                    if ((un.isEmpty() && pw.isEmpty()) || un.isEmpty()) {
                                        hideDialog();
                                        showAlertDialog(MainActivity.this, "Log In",
                                                "Please enter a valid username.", false);
                                        temp1++;
                                        user.requestFocus();
                                        break;
                                    }
                                    if (pw.isEmpty()) {
                                        hideDialog();
                                        showAlertDialog(MainActivity.this, "Log In",
                                                "Please enter a valid password.", false);
                                        temp1++;
                                        pass.requestFocus();
                                        break;
                                    }
                                    if (un.equals(_id) && !pw.equals(_image)) {
                                        hideDialog();
                                        counter++;
                                        showAlertDialog(MainActivity.this, "Log In",
                                                "Invalid password! " + counter + " out of 3  attempts to blocked.", false);
                                        temp1++;
                                        pass.requestFocus();
                                        pass.selectAll();
                                        break;
                                    }
                                    if (un.equals(_id) && _statuses.equals("BLOCKED")) {
                                        hideDialog();
                                        showAlertDialog(MainActivity.this, "Log In",
                                                "Account Was Blocked!", false);
                                        temp1++;
                                        user.setText("");
                                        user.requestFocus();
                                        pass.setText("");
                                        break;
                                    }
                                }
                                if (counter == 3) {
                                    hideDialog();
                                    showAlertDialog(MainActivity.this, "Log In",
                                            "Account Has Been Blocked! Username: " + user.getText() + ". Please contact the admin for assisstance.", false);
                                    JSONBlockUser();
                                    counter = 0;
                                    user.setText("");
                                    user.requestFocus();
                                    pass.setText("");
                                    temp1++;
                                }
                                if (temp1 == 0) {
                                    hideDialog();
                                    showAlertDialog(MainActivity.this, "Log In",
                                            "Username was not found!", false);
                                    user.requestFocus();
                                    user.selectAll();
                                    pass.setText("");
                                    counter = 0;
                                }
                            } catch (Exception e) {
                                e.printStackTrace();
                            }
                        }
                    },
                    new Response.ErrorListener() {
                        @Override
                        public void onErrorResponse(VolleyError volleyError) {
                            //Toast.makeText(getApplicationContext(), volleyError.getMessage(), Toast.LENGTH_SHORT).show();
                        }
                    }
            );
            AppController.getInstance().addToRequestQueue(jsonArrayRequest);
        }
    }
}