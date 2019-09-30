package info.androidhive.capstoneproj.model;

/**
 * Created by Babyyy on 6/29/2015.
 */
public class Product {
    public String name;
    public String images;
    public String description;
    public String category;
    public int price;
    public boolean selected;

    public Product(String name, String images, String description, String category, int price) {
        this.name = name;
        this.images = images;
        this.description = description;
        this.category = category;
        this.price = price;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getImages() {
        return images;
    }

    public void setImages(String images) {
        this.images = images;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public String getCategory() {
        return category;
    }

    public void setCategory(String category) {
        this.category = category;
    }

    public int getPrice() {
        return price;
    }

    public void setPrice(int price) {
        this.price = price;
    }
}