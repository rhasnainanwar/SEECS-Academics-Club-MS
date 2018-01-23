import smtplib
import sys

from string import Template
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText

def read_template(filename):
    with open(filename, 'r', encoding='utf-8') as template_file:
        template_file_content = template_file.read()
    return Template(template_file_content)

if __name__ == '__main__':
	userName = ''
	password = ''

	serv = smtplib.SMTP(host='smtp.gmail.com', port='587')
	source = sys.argv[1]
	to = sys.argv[3]
	message_template = read_template(source+'.txt')
	try:
		serv.starttls()
		serv.login(userName,password)

		msg = MIMEMultipart()       # create a message

		# add in the actual person name to the message template
		message = message_template.substitute(NAME=sys.argv[2], EMAIL=to, PASSWORD=sys.argv[4])

		# setup the parameters of the message
		msg['From'] = userName
		msg['To'] = to
		msg['Subject'] = "Registration - SEECS Academics Club"

		# add in the message body
		msg.attach(MIMEText(message, 'plain'))

		serv.send_message(msg)
		serv.close()
		#print('Email sent!')
	except:
		#print("Error occured")
		pass