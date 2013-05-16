package br.com.transfacearcheckin.activity;

import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;

import br.com.transfacearcheckin.ajax.MainAjax;
import br.com.transfacearckeckin.R;

import android.os.Bundle;
import android.app.Activity;
import android.content.Intent;
import android.view.Menu;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.ProgressBar;

public class MainActivity extends Activity implements OnClickListener {
	
	private Button btn_solic_visto;
	private Button btn_situacao_visto;
	private ProgressBar loading_periodo_solicitacao;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_main);
		
		this.capturaViews();
		
		this.btn_situacao_visto.setText("situação do visto (" + this.getMonthAndYear() + ")");
		
		//Ajax que busca o periodo de solicitacao dos vistos
		MainAjax Ajax = new MainAjax();
		Ajax.setView(getWindow().getDecorView().getRootView());
		Ajax.execute();
		
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.activity_main, menu);
		return true;
	}
	
	private void capturaViews() {
		this.btn_situacao_visto = (Button) findViewById(R.id.btn_situacao_visto);
		this.btn_solic_visto = (Button) findViewById(R.id.btn_solic_visto);
		
		this.btn_solic_visto.setOnClickListener(this);
		this.btn_situacao_visto.setOnClickListener(this);
	}
	
	public void onClick(View view) {
		
		switch(view.getId()) {
			case R.id.btn_solic_visto:
				
				Intent solicitacao_visto = new Intent(this, SolicitarVistoActivity.class);
				startActivity(solicitacao_visto);
				
			break;
			
			case R.id.btn_situacao_visto:
				
				Intent situacao_visto = new Intent(this, SituacaoVistoActivity.class);
				startActivity(situacao_visto);
				
			break;
				
		}
		
	}	
	
	private String getMonthAndYear() {
		SimpleDateFormat df = new SimpleDateFormat("MM/yyyy");
		Date data = Calendar.getInstance().getTime();
		String sData = df.format(data);
		return sData;
	}

}
