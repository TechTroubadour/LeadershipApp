package com.example.leadershipapp;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URI;
import java.net.URL;
import java.net.URLConnection;
import java.util.ArrayList;

import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;

import android.net.Uri;
import android.os.Bundle;
import android.os.StrictMode;
import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.Typeface;
import android.view.Menu;
import android.view.View;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TabHost;
import android.widget.TabHost.TabSpec;
import android.widget.TextView;

public class MainActivity extends Activity {

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
//		StrictMode.ThreadPolicy policy = new StrictMode.ThreadPolicy.Builder().detectAll().penaltyLog().build(); 
//		StrictMode.setThreadPolicy(policy);
		setContentView(R.layout.activity_main);
		TabHost th = (TabHost) findViewById (R.id.tabhost);
		th.setup();
		TabSpec specs = th.newTabSpec("tag1");
		specs.setContent(R.id.tab1);
		specs.setIndicator("Events");
		th.addTab(specs);
		specs = th.newTabSpec("tag2");
		specs.setContent(R.id.tab2);
		specs.setIndicator("Fundraising");
		th.addTab(specs);
		specs = th.newTabSpec("tag3");
		specs.setContent(R.id.tab3);
		specs.setIndicator("Media");
		th.addTab(specs);
		reload(null);
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.main, menu);
		return true;
	}
	
	public void goToVideo (View view) {
		String video_path = "www.youtube.com/watch?v=S9kqJ9SkZc4";
		Uri uri = Uri.parse(video_path);

		// With this line the Youtube application, if installed, will launch immediately.
		// Without it you will be prompted with a list of the application to choose.
		uri = Uri.parse("vnd.youtube:"  + uri.getQueryParameter("v"));

		Intent intent = new Intent(Intent.ACTION_VIEW, uri);
		startActivity(intent);
	}
	
    public void goToTix (View view) {
        goToUrl ("https://www.vendini.com/ticket-software.html?t=tix&w=f1f8510a3fb659e2555d210b59d7bd33");
    }
    
    public void reload(View view) {
		GetTest test = new GetTest();
		String returned = "If you see this text, the page has not loaded properly.  Make sure you have an Internet connection, and try again.";
		try {
			returned = test.getInternetData();
		} catch (Exception e) {
			e.printStackTrace();
		}
		returned = returned.replaceAll("\t","");
		System.out.println(returned);
		String[] lines = returned.split("\\r?\\n");
		System.out.println(lines.length);
		ArrayList<String[]> strings = new ArrayList<String[]>();
		strings.add(new String[300]);
		int n = 0;
		int z = 0;
		for(int i = 0; i<lines.length; i++){
			if(lines[i].equals("BREAK")){
				strings.add(new String[300]);
				z++;
				n = 0;
			}else{
				strings.get(z)[n] = lines[i];
				n++;
			}
			
		}
		System.out.println(strings.size());
		Typeface tf = Typeface.create("Arial", Typeface.ITALIC);
		Typeface tf2 = Typeface.create("Arial", Typeface.BOLD);
		ArrayList<EventItem> eI = new ArrayList<EventItem>();
		for(String[] s: strings){
			eI.add(new EventItem(s, this, tf, tf2));
		}
		LinearLayout linearLayout = (LinearLayout) findViewById(R.id.tab1_ll);
		linearLayout.removeAllViews();
		for(EventItem e: eI){
			linearLayout.addView(e.getView());
		}
    }

    private void goToUrl (String url) {
        Uri uriUrl = Uri.parse(url);
        Intent launchBrowser = new Intent(Intent.ACTION_VIEW, uriUrl);
        startActivity(launchBrowser);
    }
}
