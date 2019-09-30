package info.androidhive.capstoneproj.cart;

/**
 * Created by Babyyy on 7/1/2015.
 */

import android.app.Activity;
import android.app.AlertDialog;
import android.app.Dialog;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;

import android.telephony.SmsManager;
import android.telephony.TelephonyManager;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.Window;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.StringRequest;


import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import info.androidhive.capstoneproj.CatalogActivity;
import info.androidhive.capstoneproj.MainActivity;
import info.androidhive.capstoneproj.R;
import info.androidhive.capstoneproj.adapter.ProductAdapter;
import info.androidhive.capstoneproj.connection.ConnectionDetector;
import info.androidhive.capstoneproj.connection.NoInternetActivity;
import info.androidhive.capstoneproj.controller.AppController;
import info.androidhive.capstoneproj.model.Product;
import info.androidhive.capstoneproj.session.SessionManager;

public class ShoppingCartActivity extends Activity {

    // Refresh menu item
    MenuItem refreshMenuItem;

    String msg1, msg2, msg3, menu, rdz;
    int subTotal = 0;
    List<Product> mCartList;
    ProductAdapter mProductAdapter;

    static final String TAG = ShoppingCartActivity.class.getSimpleName();
    static ProgressDialog pDialog;
    static List<Product> catalog;
    static Map<Product, ShoppingCartEntry> cartMap = new HashMap<Product, ShoppingCartEntry>();
    EditText username, quantity, date, amount, contactpar;

    Context context = this;
    String jsonResponse;
    TextView deza, product, usersession, itemscart;
    String _id;
    EditText load;
    JSONObject jsonObject;
    Boolean isInternetPresent = false;
    ConnectionDetector cd;
    SessionManager session;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.shoppingcart);

        // Enabling Up / Back navigation
        getActionBar().setDisplayHomeAsUpEnabled(true);
        getActionBar().setHomeButtonEnabled(true);
        setTitle("Food Cart");

        cd = new ConnectionDetector(getApplicationContext());
        isInternetPresent = cd.isConnectingToInternet();
        if (!isInternetPresent) {
            Intent intent = new Intent(ShoppingCartActivity.this, NoInternetActivity.class);
            startActivity(intent);
            finish();
        }

        session = new SessionManager(getApplicationContext());
        session.checkLogin();

        usersession = (TextView) findViewById(R.id.usersession);
        HashMap<String, String> un = session.getUserDetails();
        String showsession = un.get(SessionManager.KEY_NAME);
        usersession.setText("Logged in as " + showsession);

        mCartList = ShoppingCartHelper.getCartList();
        itemscart = (TextView) findViewById(R.id.itemscart);
        itemscart.setText(String.valueOf(mCartList.size()) + " items in cart");

        pDialog = new ProgressDialog(context);
        pDialog.setMessage("Please wait...");
        pDialog.setCancelable(false);

        username = (EditText) findViewById(R.id.username);
        product = (TextView) findViewById(R.id.product);
        quantity = (EditText) findViewById(R.id.quantity);
        date = (EditText) findViewById(R.id.date);
        amount = (EditText) findViewById(R.id.amount);
        contactpar = (EditText) findViewById(R.id.contactpar);
        load = (EditText) findViewById(R.id.load);

        deza = (TextView) findViewById(R.id.deza);

        ListView listViewCatalog = (ListView) findViewById(R.id.ListViewCatalog);
        mProductAdapter = new ProductAdapter(mCartList, getLayoutInflater(), true);
        listViewCatalog.setAdapter(mProductAdapter);
        listViewCatalog.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, final int position,
                                    long id) {
                //Product selectedProduct = mCartList.get(position);
                // Toast.makeText(getApplicationContext(), "" + position, Toast.LENGTH_SHORT).show();
                /*if (selectedProduct.selected == true) {
                    selectedProduct.selected = false;
                } else {
                    selectedProduct.selected = true;
                }*/

                //mProductAdapter.notifyDataSetInvalidated();

                //List<Product> catalog1 = ShoppingCartHelper.getCatalog(getResources());

                AlertDialog.Builder alertDialog = new AlertDialog.Builder(ShoppingCartActivity.this);
                // Setting Dialog Title
                alertDialog.setTitle("Remove from Cart");
                // Setting Dialog Message
                alertDialog.setMessage("Are you sure you want remove from cart? Item #: " + (position + 1));
                // Setting Positive "Yes" Button
                alertDialog.setPositiveButton("YES", new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog1, int which) {
                        //////////////////////////////////////////////////////////////////////
                        final List<Product> cart1 = ShoppingCartHelper.getCartList();
                        int productIndex = position;
                        final Product selectedProduct1 = cart1.get(productIndex);
                        int quantity = 0;
                        ShoppingCartHelper.setQuantity(selectedProduct1, quantity);
                        cart1.remove(position);
                        mProductAdapter.notifyDataSetChanged();
                        Intent haha = new Intent(ShoppingCartActivity.this, ShoppingCartActivity.class);
                        startActivity(haha);
                        finish();
                        int zero = 0;
                        zero = position;
                        productIndex = zero;
                        itemscart.setText(String.valueOf(cart1.size()) + " items in cart");
                    }
                });
                // Setting Negative "NO" Button
                alertDialog.setNegativeButton("NO", new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog1, int which) {
                        dialog1.cancel();
                    }
                });
                // Showing Alert Message
                alertDialog.show();
            }
        });

        /*ButtonRemoveFromCart = (Button) findViewById(R.id.ButtonRemoveFromCart);
        ButtonRemoveFromCart.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                for (int i = mCartList.size() - 1; i >= 0; i--) {

                    if (mCartList.get(i).selected) {
                        ShoppingCartHelper.setQuantity(mCartList.get(i), 0);
                        mCartList.remove(i);
                    }
                }
                mProductAdapter.notifyDataSetChanged();
            }
        });*/

        SessionManager session = new SessionManager(getApplicationContext());
        session.checkLogin();
        HashMap<String, String> user = session.getUserDetails();
        username.setText(user.get(SessionManager.KEY_NAME));
        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest("http://192.168.1.172/capstone/JSONLoad2.php?_username=" + username.getText(),
                new Response.Listener<JSONArray>() {
                    @Override
                    public void onResponse(JSONArray jsonArray) {
                        jsonResponse = "";
                        Log.d(TAG, jsonArray.toString());
                        showDialog();
                        try {
                            for (int i = 0; i < jsonArray.length(); i++) {
                                jsonObject = jsonArray.getJSONObject(i);
                                _id = jsonObject.getString("_load");
                                rdz = jsonObject.getString("_contact_no_of_guardian");
                                load.setText(_id);
                                contactpar.setText(rdz);
                                //Toast.makeText(getApplicationContext(), _id, Toast.LENGTH_SHORT).show();
                            }
                        } catch (Exception e) {
                            e.printStackTrace();
                        }
                        hideDialog();
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError volleyError) {
                    }
                }
        );
        AppController.getInstance().addToRequestQueue(jsonArrayRequest);
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
                Intent intent = new Intent(ShoppingCartActivity.this, NoInternetActivity.class);
                startActivity(intent);
                finish();
            } else {
                Intent intent = new Intent(ShoppingCartActivity.this, ShoppingCartActivity.class);
                startActivity(intent);
                finish();
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

        //noinspection SimplifiableIfStatement
        if (id == R.id.refresh) {
            // refresh
            refreshMenuItem = item;
            // load the data from server
            new SyncData().execute();
            return true;
        }
        if (id == R.id.checkout) {
            if (mCartList.isEmpty()) {
                showAlertDialog(ShoppingCartActivity.this, "Shopping Cart",
                        "Your Shopping cart was empty.", false);
                return false;
            }
            ////////////////////////////////////////////////////////////////////////////////////////////
            final Dialog dialog = new Dialog(ShoppingCartActivity.this);
            dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
            dialog.setContentView(R.layout.bill_info);

            TextView prodname = (TextView) dialog.findViewById(R.id.pname);
            TextView proddes = (TextView) dialog.findViewById(R.id.pdes);
            TextView prodcateg = (TextView) dialog.findViewById(R.id.pcateg);
            TextView prodqty = (TextView) dialog.findViewById(R.id.pqty);
            TextView prodprice = (TextView) dialog.findViewById(R.id.pprice);
            TextView prodsubtotal = (TextView) dialog.findViewById(R.id.psubtotal);
            TextView prodtotal = (TextView) dialog.findViewById(R.id.total);
            String deza1 = "", deza2 = "", deza3 = "", deza4 = "", deza5 = "", deza6 = "";
            int total = 0;

            List<Product> catalog = ShoppingCartHelper.getCartList();
            Product selectedProduct;
            for (int i = 0; i < catalog.size(); i++) {
                selectedProduct = catalog.get(i);
                deza1 += selectedProduct.getName() + "\n";
                deza2 += selectedProduct.getDescription() + "\n";
                deza3 += selectedProduct.getCategory() + "\n";

                String anyeye = String.valueOf(ShoppingCartHelper.getProductQuantity(selectedProduct));
                deza4 += anyeye + "\n";

                int price = Integer.parseInt(String.valueOf(selectedProduct.getPrice()));
                deza5 += selectedProduct.getPrice() + "\n";

                int subt = Integer.parseInt(anyeye) * price;
                deza6 += String.valueOf(subt) + "\n";

                total += subt;

                prodname.setText(deza1);
                proddes.setText(deza2);
                prodcateg.setText(deza3);
                prodqty.setText(deza4);
                prodprice.setText(deza5);
                prodsubtotal.setText(deza6);
                prodtotal.setText("Total Price: P" + String.valueOf(total));
            }
            Button hehe = (Button) dialog.findViewById(R.id.cancel);
            hehe.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    dialog.dismiss();
                }
            });

            Button haha = (Button) dialog.findViewById(R.id.checkout);
            haha.setOnClickListener(new View.OnClickListener() {

                @Override
                public void onClick(View v) {
                    // TODO Auto-generated method stub
                    AlertDialog.Builder alertDialog = new AlertDialog.Builder(ShoppingCartActivity.this);

                    // Setting Dialog Title
                    alertDialog.setTitle("Checkout Confirmation");
                    // Setting Dialog Message
                    alertDialog.setMessage("Are you sure you want checkout?");
                    // Setting Positive "Yes" Button
                    alertDialog.setPositiveButton("YES", new DialogInterface.OnClickListener() {
                        public void onClick(DialogInterface dialog1, int which) {
                            try {
                                dialog.dismiss();
                                dialog1.cancel();
                                sendSMS();
                                /////////////////
                                AlertDialog.Builder alertDialog1 = new AlertDialog.Builder(ShoppingCartActivity.this);

                                // Setting Dialog Title
                                alertDialog1.setTitle("Transaction");
                                // Setting Dialog Message
                                alertDialog1.setMessage("Do u want to transact again?");
                                // Setting Positive "Yes" Button
                                alertDialog1.setPositiveButton("YES", new DialogInterface.OnClickListener() {
                                    public void onClick(DialogInterface dialog1, int which) {
//                                        try {
                                            dialog.dismiss();
                                            dialog1.cancel();


                                        //mProductAdapter.notifyDataSetChanged();

//                                        Intent ajejeje = new Intent(ShoppingCartActivity.this,CatalogActivity.class);
//                                        startActivity(ajejeje);finish();
//                                        } catch (InterruptedException e) {
//                                            e.printStackTrace();
//                                        }
                                    }
                                });
                                // Setting Negative "NO" Button
                                alertDialog1.setNegativeButton("NO", new DialogInterface.OnClickListener() {
                                    public void onClick(DialogInterface dialog1, int which) {
                                        //dialog.dismiss();
                                        dialog1.cancel();
                                        session.logoutUser();
                                        finish();
                                    }
                                });
                                // Showing Alert Message
                                alertDialog1.show();
                                //////////////////
                            } catch (InterruptedException e) {
                                e.printStackTrace();
                            }
                        }
                    });
                    // Setting Negative "NO" Button
                    alertDialog.setNegativeButton("NO", new DialogInterface.OnClickListener() {
                        public void onClick(DialogInterface dialog1, int which) {
                            //dialog.dismiss();
                            dialog1.cancel();
                        }
                    });
                    // Showing Alert Message
                    alertDialog.show();
                }
            });
            dialog.show();
            //////////////////////////////////////////////////////////////////////////////////////////
            return true;
        }
        return super.onOptionsItemSelected(item);
    }

    public void sendSMS() throws InterruptedException {
        final SmsManager sms = SmsManager.getDefault();

        mCartList = ShoppingCartHelper.getCartList();
        menu = "";
        msg1 = "";
        msg2 = "";
        msg3 = "";

        final Dialog dialog = new Dialog(ShoppingCartActivity.this);
        dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
        dialog.setContentView(R.layout.bill_info);

        final TextView prodname = (TextView) dialog.findViewById(R.id.pname);
        final TextView proddes = (TextView) dialog.findViewById(R.id.pdes);
        final TextView prodcateg = (TextView) dialog.findViewById(R.id.pcateg);
        final TextView prodqty = (TextView) dialog.findViewById(R.id.pqty);
        final TextView prodprice = (TextView) dialog.findViewById(R.id.pprice);
        final TextView prodsubtotal = (TextView) dialog.findViewById(R.id.psubtotal);
        final TextView prodtotal = (TextView) dialog.findViewById(R.id.total);
        String deza1 = "", deza2 = "", deza3 = "", deza4 = "", deza5 = "", deza6 = "";
        int total = 0;

        List<Product> catalog = ShoppingCartHelper.getCartList();
        Product selectedProduct;
        for (int i = 0; i < catalog.size(); i++) {
            selectedProduct = catalog.get(i);
            deza1 += selectedProduct.getName() + ",";
            deza2 += selectedProduct.getDescription() + "\n";
            deza3 += selectedProduct.getCategory() + "\n";

            String anyeye = String.valueOf(ShoppingCartHelper.getProductQuantity(selectedProduct));
            deza4 += anyeye + ",";

            int price = Integer.parseInt(String.valueOf(selectedProduct.getPrice()));
            deza5 += selectedProduct.getPrice() + ",";

            int subt = Integer.parseInt(anyeye) * price;
            deza6 += String.valueOf(subt) + ",";

            total += subt;
            amount.setText(String.valueOf(total));

            prodname.setText(deza1);
            proddes.setText(deza2);
            prodcateg.setText(deza3);
            prodqty.setText(deza4);
            prodprice.setText(deza5);
            prodsubtotal.setText(deza6);
            prodtotal.setText("Total Price: P" + String.valueOf(total));

            // message 1
            msg1 += "Total: Php"+ String.valueOf(amount.getText()) + " = P" + deza5 + "x" + deza4 + " of " + deza1 + " (" + deza3 + ")";
        }

        // if load was insufficient or reached the minimum bal
        int loada = Integer.parseInt(load.getText().toString());
        int getload = Integer.parseInt(amount.getText().toString());
        int finalload = loada - getload;
        if (loada < 50) {
            showAlertDialog(ShoppingCartActivity.this, "Shopping Cart", "Your balance has reached the exceeding balance!", false);
            return;
        }
        if (loada < getload) {
            showAlertDialog(ShoppingCartActivity.this, "Shopping Cart", "Insufficient Balance! ", false);
            return;
        }

        SessionManager session = new SessionManager(getApplicationContext());
        session.checkLogin();
        HashMap<String, String> user = session.getUserDetails();
        String update_url = "http://192.168.1.172/capstone/JSONLoad.php?_username=" + user.get(SessionManager.KEY_NAME) + "&_load=" + finalload;
        JsonObjectRequest update_request = new JsonObjectRequest(update_url,
                null, new Response.Listener<JSONObject>() {
            @Override
            public void onResponse(JSONObject response) {
                try {
                    int success = response.getInt("success");
                    if (success == 1) {
                       // pDialog.dismiss();
                    } else {
                       // pDialog.dismiss();
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
            }
        });
        AppController.getInstance().addToRequestQueue(update_request);

        // transaction date and time ordered
        Calendar c = Calendar.getInstance();
        SimpleDateFormat df = new SimpleDateFormat("MM-dd-yyyy");
//        final Date e = new Date();
        final String formattedDate = df.format(c.getTime());

        msg3 = "The total amount paid as of " + formattedDate + " is P" + String.valueOf(amount.getText().toString());
        TelephonyManager tm = (TelephonyManager) getSystemService(TELEPHONY_SERVICE);
        //String number = tm.getLine1Number();
        //System.out.println(number);
        String number = contactpar.getText().toString();
        Toast.makeText(getApplicationContext(), "Sending Message...", Toast.LENGTH_LONG).show();
        menu = "Prepaid Cafeteria" +
                "\nYour son or daughter ordered these items.\n"+ msg1 + "\n" + msg2  + msg3+"\nThank you!";

        String url = "http://192.168.1.172/capstone/JSONInsert.php";
        final StringRequest postRequest = new StringRequest(Request.Method.POST, url,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                    }
                }, new Response.ErrorListener() {
            public void onErrorResponse(VolleyError er) {
            }
        }) {
            @Override
            protected Map<String, String> getParams() {
                Map<String, String> params = new HashMap<String, String>();
                params.put("user", username.getText().toString());
                params.put("product", prodname.getText().toString());
                params.put("quantity", prodqty.getText().toString());
                params.put("amount", prodprice.getText().toString());
                //params.put("status", "PENDING" );
                params.put("total", amount.getText().toString());
                //params.put("timeOrder",String.valueOf(e.getTime()));
               // params.put("date", formattedDate.toString());
                return params;
            }
        };
        AppController.getInstance().addToRequestQueue(postRequest);

        sms.sendTextMessage(number, null, menu, null, null);

        // clear shopping cart after transaction
        for (int i = mCartList.size() - 1; i >= 0; i--) {
            final List<Product> cart1 = ShoppingCartHelper.getCartList();
            final Product selectedProduct1 = cart1.get(i);
            int quantity = 0;
            ShoppingCartHelper.setQuantity(selectedProduct1, quantity);
            cart1.remove(selectedProduct1);
        }
        mProductAdapter.notifyDataSetChanged();

       // Intent haha = new Intent(ShoppingCartActivity.this, ShoppingCartActivity.class);
       // //startActivity(haha);
       // finish();

        showAlertDialog(ShoppingCartActivity.this, "Successfully Transaction", menu, true);
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

    @Override
    protected void onResume() {
        super.onResume();

        // Refresh the data
        if (mProductAdapter != null) {
            mProductAdapter.notifyDataSetChanged();
        }

        double subTotal = 0;
        for (Product p : mCartList) {
            int quantity = ShoppingCartHelper.getProductQuantity(p);
            subTotal += p.price * quantity;
        }

        TextView productPriceTextView = (TextView) findViewById(R.id.TextViewSubtotal);
        productPriceTextView.setText("Subtotal: P" + subTotal);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.main2, menu);
        return true;
    }
}