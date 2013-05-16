package br.com.transfacearcheckin.lib;

//bibliotecas java
import java.util.ArrayList;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.URI;
//bibliotecas http para conex�o

import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.conn.params.ConnManagerParams;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.params.HttpConnectionParams;
import org.apache.http.params.HttpParams;


public class Ajax {
	public static final int HTTP_TIMEOUT = 30 * 1000; //vari�vel para conex�o com o servidor
	private static HttpClient httpClient; //inst�ncia do HttpClient
	
	private static HttpClient getHttpClient(){ //m�todo para receber os valores do HttpClient
		if (httpClient == null){ //se httpCient for null
			httpClient = new DefaultHttpClient();///inicializa httpClient com valor padr�o
			final HttpParams httpParams = httpClient.getParams();///recebe o valor do httpClient
			HttpConnectionParams.setConnectionTimeout(httpParams, HTTP_TIMEOUT);
			HttpConnectionParams.setSoTimeout(httpParams, HTTP_TIMEOUT);//par�metros de tempo de conex�o
			ConnManagerParams.setTimeout(httpParams, HTTP_TIMEOUT);//gerenciador da conex�o
		}
		return httpClient;	
	}
	
	public static String httpPost(String url, ArrayList<NameValuePair> parametrosPost) throws Exception{
		BufferedReader bufferReader = null;
		try{
			HttpClient client = getHttpClient();
			HttpPost httpPost = new HttpPost(url);//requisi��o da url
			UrlEncodedFormEntity FormEntity = new UrlEncodedFormEntity(parametrosPost);
			httpPost.setEntity(FormEntity);
			HttpResponse httpResponse = client.execute(httpPost);
			bufferReader = new BufferedReader(new InputStreamReader(httpResponse.getEntity().getContent()));
			StringBuffer stringBuffer = new StringBuffer("");
			String line = "";
			String LS = System.getProperty("line.separator");//separador de linha
			while ((line = bufferReader.readLine()) != null){//enquanto leitor de linha(bufferReader) ler uma linha, add outra linha
				stringBuffer.append(line + LS);
			}
			bufferReader.close();
			
			String resultado = stringBuffer.toString();
			return resultado;
		} catch(Exception e) {
			e.printStackTrace();
			return "";
		}
		finally{
			if (bufferReader != null){
				try{
					bufferReader.close();
				}
				catch(IOException e){
					e.printStackTrace();
				}
			}
		}
		
	}
	
	public static String httpGet(String url) throws Exception{
		BufferedReader bufferReader = null;
		try{
			HttpClient client = getHttpClient();
			HttpGet httpGet = new HttpGet(url);//requisi��o da url
			httpGet.setURI(new URI(url));
			HttpResponse httpResponse = client.execute(httpGet);
			bufferReader = new BufferedReader(new InputStreamReader(httpResponse.getEntity().getContent()));
			StringBuffer stringBuffer = new StringBuffer("");
			String line = "";
			String LS = System.getProperty("line.separator");//separador de linha
			while ((line = bufferReader.readLine()) != null){//enquanto leitor de linha(bufferReader) ler uma linha, add outra linha
				stringBuffer.append(line + LS);
			}
			bufferReader.close();
			
			String resultado = stringBuffer.toString();
			return resultado;
		}
		finally{
			if (bufferReader != null){
				try{
					bufferReader.close();
				}
				catch(IOException e){
					e.printStackTrace();
				}
			}
		}
		
	}
}



















