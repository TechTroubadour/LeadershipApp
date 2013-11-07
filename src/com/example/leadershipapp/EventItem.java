package com.example.leadershipapp;

import java.io.IOException;
import java.io.InputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLConnection;

import android.content.Context;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.Typeface;
import android.view.View;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;

public class EventItem {
	String[] items;
	View[] viewItems = new View[9];
	int i = 1;
	int n = 0;
	View v;
	public EventItem(String[] list,Context c,Typeface tf, Typeface tf2){
		items = list;
		LinearLayout linearLayout2 = new LinearLayout(c);
		v = linearLayout2;
		LinearLayout linearLayout3 = new LinearLayout(c);
		linearLayout3.setOrientation(LinearLayout.VERTICAL);
		
		ImageView mImgView1 = new ImageView(c);

        String url = "http://www.algronrpg.com/appXml/"+list[0];
        BitmapFactory.Options bmOptions;
        bmOptions = new BitmapFactory.Options();
        bmOptions.inSampleSize = 1;
        Bitmap bm = loadBitmap(url, bmOptions);
        mImgView1.setImageBitmap(bm);
		
		
		
		TextView tv1 = new TextView(c);
		tv1.setText(getItem());
		tv1.setTypeface(tf);
		
		TextView tv2 = new TextView(c);
		tv2.setText(getItem());
		tv2.setTypeface(tf2);

		TextView tv3 = new TextView(c);
		tv3.setText(getItem());
		TextView tv4 = new TextView(c);
		tv4.setText(getItem());
		TextView tv5 = new TextView(c);
		tv5.setText(getItem());
		TextView tv6 = new TextView(c);
		tv6.setText(getItem());
		TextView tv7 = new TextView(c);
		tv7.setText(getItem());
		

		linearLayout2.addView(mImgView1);
		linearLayout2.addView(linearLayout3);
		linearLayout3.addView(tv1);
		linearLayout3.addView(tv2);
		linearLayout3.addView(tv3);
		linearLayout3.addView(tv4);
		linearLayout3.addView(tv5);
		linearLayout3.addView(tv6);
		linearLayout3.addView(tv7);
	}
	public View getView(){
		return v;
	}
	public String getItem(){
		i++;
		if(i>items.length)
			i = 1;
		return items[i-1];
	}

    public static Bitmap loadBitmap(String URL, BitmapFactory.Options options) {
        Bitmap bitmap = null;
        InputStream in = null;
        try {
            in = OpenHttpConnection(URL);
            bitmap = BitmapFactory.decodeStream(in, null, options);
            in.close();
        } catch (IOException e1) {
        }
        return bitmap;
    }

    private static InputStream OpenHttpConnection(String strURL)
            throws IOException {
        InputStream inputStream = null;
        URL url = new URL(strURL);
        URLConnection conn = url.openConnection();

        try {
            HttpURLConnection httpConn = (HttpURLConnection) conn;
            httpConn.setRequestMethod("GET");
            httpConn.connect();

            if (httpConn.getResponseCode() == HttpURLConnection.HTTP_OK) {
                inputStream = httpConn.getInputStream();
            }
        } catch (Exception ex) {
        }
        return inputStream;
    }

}
