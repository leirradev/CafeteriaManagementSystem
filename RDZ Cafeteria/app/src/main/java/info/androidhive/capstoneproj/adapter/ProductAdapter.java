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
import info.androidhive.capstoneproj.model.Product;


public class ProductAdapter extends BaseAdapter {

    List<Product> mProductList;
    LayoutInflater inflater;
    boolean mShowQuantity;
    ImageLoader imageLoader = AppController.getInstance().getImageLoader();

    public ProductAdapter(List<Product> list, LayoutInflater inflater, boolean showQuantity) {
        mProductList = list;
        this.inflater = inflater;
        mShowQuantity = showQuantity;
    }

    private class ViewHolder {
        TextView name, price;
    }

    @Override
    public int getCount() {
        return mProductList.size();
    }

    @Override
    public Object getItem(int position) {
        return mProductList.get(position);
    }

    @Override
    public long getItemId(int position) {
        return position;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        final ViewHolder holder;
        holder = new ViewHolder();
        if (convertView == null)
            convertView = inflater.inflate(R.layout.item, null);

        if (imageLoader == null)
            imageLoader = AppController.getInstance().getImageLoader();

        NetworkImageView images = (NetworkImageView) convertView
                .findViewById(R.id.ImageViewProduct);
        holder.name = (TextView) convertView.findViewById(R.id.TextViewProductTitle);
        TextView description = (TextView) convertView.findViewById(R.id.TextViewProductDetails);
        TextView category = (TextView) convertView.findViewById(R.id.TextViewProductCategory);
        holder.price = (TextView) convertView.findViewById(R.id.TextViewProductPrice);
        TextView quantity = (TextView) convertView.findViewById(R.id.txtViewCurrentlyInCart);

        Product curProduct = mProductList.get(position);

        holder.name.setText(curProduct.name);
        images.setImageUrl(curProduct.getImages(), imageLoader);
        description.setText(curProduct.description);
        category.setText(curProduct.category);
        holder.price.setText(String.valueOf(curProduct.price));

        // Show the quantity in the cart or not
        if (mShowQuantity) {
            quantity.setText("Quantity: " + ShoppingCartHelper.getProductQuantity(curProduct));
        } else {
            // Hid the view
            quantity.setVisibility(View.GONE);
        }

        return convertView;
    }

    private class ViewItem {
        ImageView productImageView;
        TextView productTitle;
        TextView productQuantity;
    }

}
