import javax.servlet.http.*;
import javax.servlet.*;
import java.io.*;


public class NameHitServlet extends HttpServlet {
  private static int mCount=0;

  public void doGet(HttpServletRequest request, HttpServletResponse response)
                                      throws ServletException, IOException {
    String fname = request.getParameter("first");
    String lname = request.getParameter("last");
    String message = "Welcome, " + fname + " " + lname + "!\nYour visit's page hit is: " + ++mCount;
    response.setContentType("text/plain");
    response.setContentLength(message.length());
    PrintWriter out = response.getWriter();
    out.println(message);
  }
}

