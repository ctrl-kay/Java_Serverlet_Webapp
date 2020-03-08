import java.util.Enumeration;
import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;

public class SumServlet extends HttpServlet
{
	private int mCount;

    public void init(ServletConfig config) throws ServletException
    {
        super.init(config);
    }

    public void doPost(HttpServletRequest  request,
                       HttpServletResponse response)
        throws IOException, ServletException
    {
        try
        {
            // First handle session
            HttpSession session = request.getSession(false);
            if (session == null)  // first connection?
            {
                session = request.getSession(true);   // create
                String requestUrl = HttpUtils.getRequestURL(request).toString();
                String rewrittenUrl = response.encodeURL(requestUrl);
                response.setHeader("X-RewrittenURL", rewrittenUrl);
            }

            // read request

            String requestStr = request.getParameter("num").trim();

            // process request, producing response
            String responseStr;
            int totalSoFar = 0;
            Integer savedTotal = (Integer)(session.getAttribute("total"));
            if (savedTotal != null)
            {
                totalSoFar = savedTotal.intValue();
            }
            try
            {
                int newValue = Integer.parseInt(requestStr);
                totalSoFar += newValue;
                responseStr = Integer.toString(totalSoFar);
            }
            catch (NumberFormatException e)
            {
                responseStr = "Error:" + requestStr;
            }
            session.setAttribute("total", new Integer(totalSoFar));

            // write response
            response.setContentType("text/plain");
            PrintWriter out = response.getWriter();
            out.write(responseStr);
            out.close();
        }
        catch (IOException e)
        {
            e.printStackTrace();
            throw e;
        }
        catch (Exception e)
        {
            e.printStackTrace();
            throw new ServletException(e.getMessage());
        }
    }


    public String getServletInfo()
    {
        return "Sum Servlet.";
    }
}
