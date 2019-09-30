package info.androidhive.capstoneproj.cart;

/**
 * Created by Babyyy on 7/1/2015.
 */

import android.app.ProgressDialog;
import android.content.res.Resources;
import android.util.Log;
import android.widget.Toast;

import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.VolleyLog;
import com.android.volley.toolbox.JsonArrayRequest;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.Vector;

import info.androidhive.capstoneproj.CatalogActivity;
import info.androidhive.capstoneproj.controller.AppController;
import info.androidhive.capstoneproj.model.Category;
import info.androidhive.capstoneproj.model.Product;

public class ShoppingCartHelper {

    static final String TAG = CatalogActivity.class.getSimpleName();
    static final String url = "http://192.168.1.172/capstone/JSONfetchimage.php";
    static final String urls = "http://192.168.1.172/capstone/JSONCategory.php";
    static ProgressDialog pDialog;
    static List<Product> catalog;
    static List<Category> catalog1;
    static List<Product> cart;
    static Map<Product, ShoppingCartEntry> cartMap = new HashMap<Product, ShoppingCartEntry>();
    static String jsonResponse;
    static JSONObject jsonObject;

    public static List<Category> JSONCategory(Resources res1) {
        if (catalog1 == null) {
            catalog1 = new Vector<Category>();
            JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(urls,
                    new Response.Listener<JSONArray>() {
                        @Override
                        public void onResponse(JSONArray response) {
                            jsonResponse = "";
                            Log.d(TAG, response.toString());
                            try {
                                String temp = "";
                                for (int i = 0; i < response.length(); i++) {
                                    jsonObject = response.getJSONObject(i);
                                    catalog1.add(new Category(jsonObject.getString("category")));
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

        }
        return catalog1;
    }

    public static List<Product> getCatalog(Resources res) {
        if (catalog == null) {
            catalog = new Vector<Product>();
            JsonArrayRequest movieReq = new JsonArrayRequest(url,
                    new Response.Listener<JSONArray>() {
                        @Override
                        public void onResponse(JSONArray response) {
                            Log.d(TAG, response.toString());
                            hidePDialog();
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
//                    hidePDialog();
                }
            });
            AppController.getInstance().addToRequestQueue(movieReq);
        }
        return catalog;
    }

    public static void setQuantity(Product product, int quantity) {
        // Get the current cart entry
        ShoppingCartEntry curEntry = cartMap.get(product);

        // If the quantity is zero or less, remove the products
        if (quantity <= 0) {
            if (curEntry != null)
                removeProduct(product);
            return;
        }

        // If a current cart entry doesn't exist, create one
        if (curEntry == null) {
            curEntry = new ShoppingCartEntry(product, quantity);
            cartMap.put(product, curEntry);
            return;
        }

        // Update the quantity
        curEntry.setQuantity(quantity);
    }

    public static int getProductQuantity(Product product) {
        // Get the current cart entry
        ShoppingCartEntry curEntry = cartMap.get(product);

        if (curEntry != null)
            return curEntry.getQuantity();

        return 0;
    }

    public static void removeProduct(Product product) {
        cartMap.remove(product);
    }

    public static List<Product> getCartList() {
        List<Product> cartList = new Vector<Product>(cartMap.keySet().size());
        for (Product p : cartMap.keySet()) {
            cartList.add(p);
        }

        return cartList;
    }

    private static void hidePDialog() {
        if (pDialog != null) {
            pDialog.dismiss();
            pDialog = null;
        }
    }
}