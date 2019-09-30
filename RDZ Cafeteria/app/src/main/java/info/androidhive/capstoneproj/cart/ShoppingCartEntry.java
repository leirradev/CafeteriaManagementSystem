package info.androidhive.capstoneproj.cart;

import info.androidhive.capstoneproj.model.Product;

/**
 * Created by Babyyy on 7/1/2015.
 */
public class ShoppingCartEntry {

    private Product mProduct;
    private int mQuantity;

    public ShoppingCartEntry(Product product, int quantity) {
        mProduct = product;
        mQuantity = quantity;
    }

    public Product getProduct() {
        return mProduct;
    }

    public int getQuantity() {
        return mQuantity;
    }

    public void setQuantity(int quantity) {
        mQuantity = quantity;
    }

}