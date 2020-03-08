//-------------------------------------PasswordServlet------------------------------------------
import javax.servlet.http.*;
import javax.servlet.*;
import java.io.*;
import java.util.*;

public class PasswordServlet extends HttpServlet {
	public void doGet(HttpServletRequest request,
			HttpServletResponse response) throws ServletException, IOException {
		System.out.println("user = " + request.getParameter("user"));
		System.out.println("timestamp = " + request.getParameter("timestamp"));
		System.out.println("random = " + request.getParameter("random"));
		System.out.println("digest = " + request.getParameter("digest"));

		// Retrieve the user name.
		String user = request.getParameter("user");

		// Look up the password for this user.
		String password = lookupPassword(user);

		// Pull the timestamp and random number (hex encoded) out of
		// of the request.
		String timestamp = request.getParameter("timestamp");
		String randomNumber = request.getParameter("random");

		// Here we would compare the timestamp with the last saved
		// timestamp for this user. We should only accept timestamps
		// that are greater than the last saved timestamp for this user.
		// Gather values for the message digest.
		byte[] userBytes = user.getBytes();
		byte[] timestampBytes = HexCodec.hexToBytes(timestamp);
		byte[] randomBytes = HexCodec.hexToBytes(randomNumber);
		byte[] passwordBytes = password.getBytes();

		// Create the message digest.
		Digest digest = new SHA1Digest();

		// Calculate the digest value.
		digest.update(userBytes, 0, userBytes.length);
		digest.update(timestampBytes, 0, timestampBytes.length);
		digest.update(randomBytes, 0, randomBytes.length);
		digest.update(passwordBytes, 0, passwordBytes.length);
		byte[] digestValue = new byte[digest.getDigestSize()];
		digest.doFinal(digestValue, 0);

		// Now compare the digest values.
		String message = "";
		String clientDigest = request.getParameter("digest");
		if (isEqual(digestValue, HexCodec.hexToBytes(clientDigest)))
			message = "User " + user + " logged in.";
		else
			message = "Login was unsuccessful.";

		// Send a response to the client.
		response.setContentType("text/plain");
		response.setContentLength(message.length());
		PrintWriter out = response.getWriter();
		out.println(message);
	}

	private String lookupPassword(String user) {
	// Here we would do a real lookup based on the user name.
	// We might look in a text file or a database. Here, we
	// just use a hardcoded value.
	return "happy8";
	}

	private boolean isEqual(byte[] one, byte[] two) {
	if (one.length != two.length) return false;
	for (int i = 0; i < one.length; i++)
		if (one[i] != two[i]) return false;
	return true;
	}
}
