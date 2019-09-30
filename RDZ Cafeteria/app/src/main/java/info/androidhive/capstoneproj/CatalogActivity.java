package info.androidhive.capstoneproj;

/**
 * Created by Babyyy on 6/26/2015.
 */

import android.app.ActionBar;
import android.app.Activity;
import android.app.AlertDialog;
import android.app.Dialog;
import android.app.ProgressDialog;
import android.app.SearchManager;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.res.Configuration;
import android.content.res.Resources;
import android.content.res.TypedArray;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.app.ActionBarDrawerToggle;
import android.support.v4.widget.DrawerLayout;
import android.telephony.SmsManager;
import android.telephony.TelephonyManager;
import android.text.Editable;
import android.text.TextWatcher;
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

import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.VolleyLog;
import com.android.volley.toolbox.ImageLoader;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.NetworkImageView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Vector;

import info.androidhive.capstoneproj.adapter.CategoryAdapter;
import info.androidhive.capstoneproj.adapter.ProductAdapter;
import info.androidhive.capstoneproj.cart.ShoppingCartActivity;
import info.androidhive.capstoneproj.cart.ShoppingCartHelper;
import info.androidhive.capstoneproj.connection.ConnectionDetector;
import info.androidhive.capstoneproj.connection.NoInternetActivity;
import info.androidhive.capstoneproj.controller.AppController;
import info.androidhive.capstoneproj.ip.IpAddress;
import info.androidhive.capstoneproj.model.Category;
import info.androidhive.capstoneproj.model.Product;
import info.androidhive.capstoneproj.session.SessionManager;


public class CatalogActivity extends Activity implements ActionBar.OnNavigationListener {

    List<Product> mCartList;//,mCartList1;
    String id, prod, quan, amt, date, usr, statuss, timeOrder, timeClaim,
            ardeezy1 = "", ardeezy2 = "", ardeezy3 = "", ardeezy4 = "", ardeezy5 = "", ardeezy6 = "", ardeezy7 = "", ardeezy8 = "";
    // action bar
    private ActionBar actionBar;

    // Refresh menu item
    private MenuItem refreshMenuItem;

    ImageLoader imageLoader = AppController.getInstance().getImageLoader();
    private List<Product> mProductList;
    private List<Category> mProductList1;
    private CategoryAdapter mProduct;
    private ListView listView;
    EditText inputSearch;
    SessionManager session;
    String urls, lorriane, rdz;
    String jsonResponse;
    String TAG = CatalogActivity.class.getSimpleName();
    JSONObject jsonObject;
    Context context = this;

//    DrawerLayout mDrawerLayout;
    ListView mDrawerList;
//    ActionBarDrawerToggle mDrawerToggle;

    // nav drawer title
    CharSequence mDrawerTitle;

    // used to store app title
    CharSequence mTitle;
    TextView txtQuery, usersession, itemscart;

    Boolean isInternetPresent = false;
    ConnectionDetector cd;
    ProgressDialog pDialog;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.catalog);

        listView = (ListView) findViewById(R.id.ListViewCatalog);
        /*mProductList = JSONProduct(getResources());
        int list1 = mProductList.size();
        if (list1 != 0) {
            mProductList.clear();
            ProductAdapter dede = new ProductAdapter(mProductList, getLayoutInflater(), false);
            listView.setAdapter(dede);
            dede.notifyDataSetChanged();
        }*/

        pDialog = new ProgressDialog(context);
        pDialog.setMessage("Loading...");
        pDialog.setCancelable(false);

        cd = new ConnectionDetector(getApplicationContext());
        isInternetPresent = cd.isConnectingToInternet();
        if (!isInternetPresent) {
            showDialog();
            Intent intent = new Intent(CatalogActivity.this, NoInternetActivity.class);
            hideDialog();
            startActivity(intent);
            finish();
        }

        txtQuery = (TextView) findViewById(R.id.txtQuery);

        actionBar = getActionBar();

        mTitle = mDrawerTitle = getTitle();

        //mDrawerLayout = (DrawerLayout) findViewById(R.id.drawer_layout);
        mDrawerList = (ListView) findViewById(R.id.list_slidermenu);

        mProductList1 = ShoppingCartHelper.JSONCategory(getResources());

        // setting the nav drawer list adapter
        mProduct = new CategoryAdapter(mProductList1, getLayoutInflater());
        mDrawerList.setAdapter(mProduct);
        mDrawerList.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                // display view for selected nav drawer item
                //List<Product> catalog1 = ShoppingCartHelper.getCatalog(getResources());
                // int productIndex = getIntent().getExtras().getInt(ShoppingCartHelper.PRODUCT_INDEX);
//                final Product selectedProduct = catalog1.get(position);
//                if (position == 1) {
//                    for (int i = 0; i < catalog1.size(); i++) {
//                        catalog1.remove(i);
//                    }
//                }
//                mProduct.notifyDataSetChanged();
                // update selected item and title, then close the drawer
                mDrawerList.setItemChecked(position, true);
                mDrawerList.setSelection(position);
                //if(position == i){
                //   setTitle("hahaha");}
//                mDrawerLayout.closeDrawer(mDrawerList);
                //if (position==1)
                //Toast.makeText(getApplicationContext(), "clicked:" + position, Toast.LENGTH_SHORT).show();

                //ProductAdapter haha = new ProductAdapter(mProductList,getLayoutInflater(),false);
                //haha.notifyDataSetChanged();
                //listView.setAdapter(new ProductAdapter(mProductList1, getLayoutInflater(), false));
            }
        });

        // enabling action bar app icon and behaving it as toggle button
        //getActionBar().setDisplayHomeAsUpEnabled(true);
        //getActionBar().setHomeButtonEnabled(true);
        setTitle("Student Meal Menu");

//        mDrawerToggle = new ActionBarDrawerToggle(this, mDrawerLayout,
//                R.drawable.ic_drawer, //nav menu toggle icon
//                R.string.app_name, // nav drawer open - description for accessibility
//                R.string.app_name // nav drawer close - description for accessibility
//        ) {
//            public void onDrawerClosed(View view) {
//                getActionBar().setTitle(mTitle);
//                // calling onPrepareOptionsMenu() to show action bar icons
//                invalidateOptionsMenu();
//            }
//
//            public void onDrawerOpened(View drawerView) {
//                getActionBar().setTitle(mDrawerTitle);
//                // calling onPrepareOptionsMenu() to hide action bar icons
//                invalidateOptionsMenu();
//            }
//        };
//        mDrawerLayout.setDrawerListener(mDrawerToggle);
//        if (savedInstanceState == null) {
//            // on first time display view for first nav item
//        }
        session = new SessionManager(getApplicationContext());
        session.checkLogin();

        itemscart = (TextView) findViewById(R.id.itemscart);
        List<Product> chups = ShoppingCartHelper.getCartList();
        itemscart.setText(String.valueOf(chups.size()) + " items in cart");

        usersession = (TextView) findViewById(R.id.usersession);
        HashMap<String, String> un = session.getUserDetails();
        String showsession = un.get(SessionManager.KEY_NAME);
        usersession.setText("Logged in as " + showsession);

        mProductList = ShoppingCartHelper.getCatalog(getResources());
        listView.setAdapter(new ProductAdapter(mProductList, getLayoutInflater(), false));
        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, final int position,
                                    long id) {
                final Dialog dialog = new Dialog(CatalogActivity.this);
                dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
                dialog.setContentView(R.layout.productdetails);
                List<Product> catalog = ShoppingCartHelper.getCatalog(getResources());
                //int productIndex = getIntent().getExtras().getInt(ShoppingCartHelper.PRODUCT_INDEX);
                final Product selectedProduct = catalog.get(position);
                // Set the proper image and text
                NetworkImageView productImageView = (NetworkImageView) dialog.findViewById(R.id.ImageViewProduct);
                productImageView.setImageUrl(selectedProduct.images, imageLoader);
                TextView productTitleTextView = (TextView) dialog.findViewById(R.id.TextViewProductTitle);
                productTitleTextView.setText(selectedProduct.name);
                TextView productDetailsTextView = (TextView) dialog.findViewById(R.id.TextViewProductDetails);
                productDetailsTextView.setText(selectedProduct.description);
                //TextView productCategoryTextView = (TextView) dialog.findViewById(R.id.TextViewProductCategory);
                //productCategoryTextView.setText(selectedProduct.category);
                TextView productPriceTextView = (TextView) dialog.findViewById(R.id.TextViewProductPrice);
                productPriceTextView.setText("P" + selectedProduct.price);
                // Update the current quantity in the cart
                TextView textViewCurrentQuantity = (TextView) dialog.findViewById(R.id.txtViewCurrentlyInCart);
                textViewCurrentQuantity.setText("Quantity: " + ShoppingCartHelper.getProductQuantity(selectedProduct));

                // Save a reference to the quantity edit text
                final EditText editTextQuantity = (EditText) dialog.findViewById(R.id.editTextQuantity);

                List<Product> catalog1 = ShoppingCartHelper.getCatalog(getResources());
                final List<Product> cart1 = ShoppingCartHelper.getCartList();
                int productIndex = position;
                final Product selectedProduct1 = catalog1.get(productIndex);
                Button addToCartButton = (Button) dialog.findViewById(R.id.ButtonAddToCart);
                addToCartButton.setOnClickListener(new View.OnClickListener() {

                    @Override
                    public void onClick(View v) {
                        // TODO Auto-generated method stub
                        int quantity = 0;
                        showDialog();
                        try {
                            quantity = Integer.parseInt(editTextQuantity.getText().toString());
                            if (quantity < 0) {
                                hideDialog();
                                showAlertDialog(CatalogActivity.this, "Shopping Cart",
                                        "Please enter a quantity of 0 or higher", false);
                                return;
                            }
                        } catch (Exception e) {
                            /*showAlertDialog(CatalogActivity.this, "Shopping Cart",
                                    "Please enter a numeric quantity", false);*/
                            return;
                        }
                        hideDialog();
                        quantity += ShoppingCartHelper.getProductQuantity(selectedProduct);
                        ShoppingCartHelper.setQuantity(selectedProduct, quantity);

                        cart1.add(selectedProduct1);
                        int itemsincart = cart1.size();
                        itemscart.setText(String.valueOf(itemsincart) + " items in cart");
                        dialog.dismiss();
                    }
                });

                dialog.show();
            }
        });
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
    public void onDestroy() {
        super.onDestroy();
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.main, menu);
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
                Intent intent = new Intent(CatalogActivity.this, NoInternetActivity.class);
                startActivity(intent);
                finish();
            }
            Intent hahaha = new Intent(CatalogActivity.this, CatalogActivity.class);
            startActivity(hahaha);
            finish();
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

    public void JSONTrans() {
        final SessionManager session = new SessionManager(getApplicationContext());
        session.checkLogin();
        final HashMap<String, String> user = session.getUserDetails();
        final Dialog dialog = new Dialog(CatalogActivity.this);
        dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
        dialog.setContentView(R.layout.transaction_history);

        final TextView ids = (TextView) dialog.findViewById(R.id.id1);
        final TextView product = (TextView) dialog.findViewById(R.id.prod1);
        final TextView quantity = (TextView) dialog.findViewById(R.id.quan1);
        final TextView amount = (TextView) dialog.findViewById(R.id.amount1);
        final TextView dates = (TextView) dialog.findViewById(R.id.date1);
        final TextView timeorder = (TextView) dialog.findViewById(R.id.timeo);
        final TextView timecliam = (TextView) dialog.findViewById(R.id.timec);
        final TextView status = (TextView) dialog.findViewById(R.id.status);

        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest("http://192.168.1.172/capstone/JSONTrans.php?user=" + user.get(SessionManager.KEY_NAME),
                new Response.Listener<JSONArray>() {
                    @Override
                    public void onResponse(JSONArray jsonArray) {
                        jsonResponse = "";
                        Log.d(TAG, jsonArray.toString());
                        showDialog();
                        try {
                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject jsonObject = jsonArray.getJSONObject(i);
                                id = jsonObject.getString("id");
                                usr = jsonObject.getString("user");
                                prod = jsonObject.getString("product");
                                quan = jsonObject.getString("quantity");
                                amt = jsonObject.getString("total");
                                statuss = jsonObject.getString("status");
                                timeOrder = jsonObject.getString("timeOrder");
                                timeClaim = jsonObject.getString("timeClaim");
                                date = jsonObject.getString("date");

                                //Toast.makeText(getApplicationContext(), _id, Toast.LENGTH_SHORT).show();
                                if (user.get(SessionManager.KEY_NAME).equals(usr)) {
                                }
                                ardeezy1 += id + "\n";
                                //output1 1\n2
                                //output2
                                ardeezy2 += prod + "\n";
                                ardeezy3 += quan + "\n";
                                ardeezy4 += amt + "\n";
                                ardeezy5 += date + "\n";
                                ardeezy6 += timeClaim + "\n";
                                ardeezy7 += timeOrder + "\n";
                                ardeezy8 += statuss + "\n";

                                ids.setText(ardeezy1);
                                product.setText(ardeezy2);
                                quantity.setText(ardeezy3);
                                amount.setText(ardeezy4);
                                dates.setText(ardeezy5);
                                timeorder.setText(ardeezy6);
                                timecliam.setText(ardeezy7);
                                status.setText(ardeezy8);
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
        Button btnclose = (Button) dialog.findViewById(R.id.btnclose);
        btnclose.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                dialog.dismiss();
                // clear
                ardeezy1 = "";
                ardeezy2 = "";
                ardeezy3 = "";
                ardeezy4 = "";
                ardeezy5 = "";
                ardeezy6 = "";
                ardeezy7 = "";
                ardeezy8 = "";
            }
        });
        dialog.show();
    }

    public List<Product> JSONProduct(Resources res) {
        String URLy = "http://192.168.1.172/capstone/JSONfetchimage.php";
        final List<Product> catalog = new Vector<Product>();
        JsonArrayRequest movieReq = new JsonArrayRequest(URLy,
                new Response.Listener<JSONArray>() {
                    @Override
                    public void onResponse(JSONArray response) {
                        Log.d(TAG, response.toString());
                        for (int i = 0; i < response.length(); i++) {
                            try {
                                JSONObject obj = response.getJSONObject(i);
                                catalog.add(new Product(obj.getString("name"), obj.getString("images"), obj.getString("description"),
                                        obj.getString("category"), obj.getInt("price")));
                            } catch (JSONException e) {
                                e.printStackTrace();
                            }
                        }
                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
//                    VolleyLog.d(TAG, "Error: " + error.getMessage());
            }
        });
        AppController.getInstance().addToRequestQueue(movieReq);
        return catalog;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // toggle nav drawer on selecting action bar app icon/title
//        if (mDrawerToggle.onOptionsItemSelected(item)) {
//            return true;
//        }
        // Handle action bar actions click
        switch (item.getItemId()) {
//            case R.id.search:
//                // later
//                return true;
            case R.id.viewtrans:
                JSONTrans();
                return true;
            case R.id.refresh:
                showDialog();
                // refresh
                refreshMenuItem = item;
                // load the data from server
                List<Product> chups = ShoppingCartHelper.getCartList();
                itemscart.setText(String.valueOf(chups.size()) + " items in cart");

                listView = (ListView) findViewById(R.id.ListViewCatalog);
                mProductList = JSONProduct(getResources());
                //ProductAdapter dodo = new ProductAdapter(mCartList, getLayoutInflater(), false);

                int list1 = mProductList.size();

                if (list1 != 0) {
                    mProductList.clear();
                    ProductAdapter dede = new ProductAdapter(mProductList, getLayoutInflater(), false);
                    listView.setAdapter(dede);
                    dede.notifyDataSetChanged();
                }
//                else if (list1 == 0) {
//                    mProductList = ShoppingCartHelper.getCatalog(getResources());
//                    mCartList.clear();
//                    listView.setAdapter(new ProductAdapter(mProductList, getLayoutInflater(), false));
//                    //mCartList = ShoppingCartHelper.getCatalogg(getResources());
//                }
                hideDialog();
                new SyncData().execute();
                return true;
            case R.id.action_setting:
                showDialog();
                //List<Product> chupp = ShoppingCartHelper.getCartList();
                //chupp.clear();
                mCartList = ShoppingCartHelper.getCatalog(getResources());
                for (int i = 0; i < mCartList.size(); i++) {
                    List<Product> catalog1 = ShoppingCartHelper.getCatalog(getResources());
                    final Product selectedProduct1 = catalog1.get(i);
                    ShoppingCartHelper.setQuantity(selectedProduct1, 0);
                }
                //itemscart = (TextView) findViewById(R.id.itemscart);
                //itemscart.setText(String.valueOf(chupp.size()) + " items in cart");
                hideDialog();
                session.logoutUser();
                finish();
                return true;
            case R.id.btnviewcart:
                showDialog();
                hideDialog();
                Intent haha = new Intent(getApplicationContext(), ShoppingCartActivity.class);
                startActivity(haha);
                //finish();
                return true;
            /*case R.id.items:
                showAlertDialog(CatalogActivity.this, "Shopping Cart",
                        mProductList.size() + " items in Cart", true);
                Toast.makeText(getApplicationContext(),mProductList.size(),Toast.LENGTH_SHORT).show();
                return true;*/
            case R.id.checkbal:
                showDialog();
                SessionManager session = new SessionManager(CatalogActivity.this);
                session.checkLogin();
                HashMap<String, String> user = session.getUserDetails();
                //Toast.makeText(getApplicationContext(),user.get(SessionManager.KEY_NAME),Toast.LENGTH_SHORT).show();
                IpAddress hahah = new IpAddress();
                hahah.getLocalIpAddress();
                urls = "http://192.168.1.172/capstone/JSONLoad2.php?_username=" + user.get(SessionManager.KEY_NAME);
                JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(urls,
                        new Response.Listener<JSONArray>() {
                            @Override
                            public void onResponse(JSONArray jsonArray) {
                                jsonResponse = "";
                                Log.d(TAG, jsonArray.toString());
                                try {
                                    String temp = "";
                                    for (int i = 0; i < jsonArray.length(); i++) {
                                        jsonObject = jsonArray.getJSONObject(i);
                                        lorriane = jsonObject.getString("_load");
                                        //rdz = jsonObject.getString("_contact_no_of_guardian");
                                        int getint = Integer.parseInt(lorriane);
                                        if (getint <= 50) {
                                            hideDialog();
                                            showAlertDialog(CatalogActivity.this, "Load Balance",
                                                    "Your load balanced is below P50. Please contact the admin and reload immediately.", false);
                                        } else {
                                            hideDialog();
                                            showAlertDialog(CatalogActivity.this, "Load Balance",
                                                    "Remaining Balance: " + lorriane, true);
                                        }
                                    }
                                } catch (Exception e) {
                                    e.printStackTrace();
                                }
                            }
                        },
                        new Response.ErrorListener() {
                            @Override
                            public void onErrorResponse(VolleyError volleyError) {
                            }
                        }
                );
                AppController.getInstance().addToRequestQueue(jsonArrayRequest);
                return true;
            default:
                return super.onOptionsItemSelected(item);
        }
    }

    @Override
    public void setTitle(CharSequence title) {
        mTitle = title;
        getActionBar().setTitle(mTitle);
    }

    /**
     * When using the ActionBarDrawerToggle, you must call it during
     * onPostCreate() and onConfigurationChanged()...
     */

//    @Override
//    protected void onPostCreate(Bundle savedInstanceState) {
//        super.onPostCreate(savedInstanceState);
//        // Sync the toggle state after onRestoreInstanceState has occurred.
//        mDrawerToggle.syncState();
//    }
//
//    @Override
//    public void onConfigurationChanged(Configuration newConfig) {
//        super.onConfigurationChanged(newConfig);
//        // Pass any configuration change to the drawer toggls
//        mDrawerToggle.onConfigurationChanged(newConfig);
//    }

    /***
     * Called when invalidateOptionsMenu() is triggered
     */
//    @Override
//    public boolean onPrepareOptionsMenu(Menu menu) {
//        // if nav drawer is opened, hide the action items
//        boolean drawerOpen = mDrawerLayout.isDrawerOpen(mDrawerList);
//        menu.findItem(R.id.action_setting).setVisible(!drawerOpen);
//        return super.onPrepareOptionsMenu(menu);
//    }

    @Override
    public boolean onNavigationItemSelected(int itemPosition, long itemId) {
        return false;
    }
}
