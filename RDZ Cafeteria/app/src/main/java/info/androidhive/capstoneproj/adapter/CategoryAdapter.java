package info.androidhive.capstoneproj.adapter;

/**
 * Created by Babyyy on 7/1/2015.
 */

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.android.volley.toolbox.ImageLoader;
import com.android.volley.toolbox.NetworkImageView;

import java.util.List;

import info.androidhive.capstoneproj.R;
import info.androidhive.capstoneproj.cart.ShoppingCartHelper;
import info.androidhive.capstoneproj.controller.AppController;
import info.androidhive.capstoneproj.model.Category;
import info.androidhive.capstoneproj.model.Product;


public class CategoryAdapter extends BaseAdapter {

    List<Category> mProductList1;
    LayoutInflater inflater;

    public CategoryAdapter(List<Category> list, LayoutInflater inflater) {
        mProductList1 = list;
        this.inflater = inflater;
    }

    private class ViewHolder {
        TextView name, price;
    }

    @Override
    public int getCount() {
        return mProductList1.size();
    }

    @Override
    public Object getItem(int position) {
        return mProductList1.get(position);
    }

    @Override
    public long getItemId(int position) {
        return position;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        if (convertView == null)
            convertView = inflater.inflate(R.layout.cat_item, null);

        TextView category = (TextView) convertView.findViewById(R.id.TextViewProductCategory);

        Category curProduct = mProductList1.get(position);
        category.setText(curProduct.category);
        return convertView;
    }

    private class ViewItem {
        ImageView productImageView;
        TextView productTitle;
        TextView productQuantity;
    }

}
