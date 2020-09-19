import os
import sys
import livepopulartimes as lpt
import mysql.connector
import time
from time import strftime
import datetime
import pytz

sys.path.insert(0, os.path.dirname(__file__))

city_dict = {
    "van": {
        "city": "Vancouver BC, Canada",
        "timezone": "PT"
    },
    "del": {
        "city": "Delta BC, Canada",
        "timezone": "PT"
    },
    "ric": {
        "city": "Richmond BC, Canada",
        "timezone": "PT"
    },
    "kel": {
        "city": "Kelowna BC, Canada",
        "timezone": "PT"
    },
    "vic": {
        "city": "Victoria BC, Canada",
        "timezone": "PT"
    },
    "tor": {
        "city": "Toronto ON, Canada",
        "timezone": "ET"
    },
    "ott": {
        "city": "Ottawa ON, Canada",
        "timezone": "ET"
    },
    "cal": {
        "city": "Calgary AB, Canada",
        "timezone": "CT"
    },
    "edm": {
        "city": "Edmonton AB, Canada",
        "timezone": "CT"
    },
    "gat": {
        "city": "Gatineau QC, Canada",
        "timezone": "ET"
    },
    "hal": {
        "city": "Halifax NS, Canada",
        "timezone": "AT"
    },
    "lon": {
        "city": "London ON, Canada",
        "timezone": "ET"
    },
    "mon": {
        "city": "Montreal QC, Canada",
        "timezone": "ET"
    },
    "nva": {
        "city": "North Vancouver BC, Canada",
        "timezone": "PT"
    },
    "she": {
        "city": "Sherbrooke QC, Canada",
        "timezone": "ET"
    },
}

def storeBusyness(restaurant_id, data, cnx):
    
    cursor = cnx.cursor(buffered=True)
    
    if data is None:
        print(restaurant_id + " NULL NULL")
        query_string = """INSERT INTO busyness (restaurant_id_6, busyness, data_type)
                        VALUES(%s, NULL, NULL)
                        ON DUPLICATE KEY UPDATE
                        busyness = NULL,
                        data_type = NULL"""
        cursor.execute(query_string, (restaurant_id,))
    else:
        print(restaurant_id + " " + str(data['busyness']) + " " + str(data['type']))
        query_string = """INSERT INTO busyness (restaurant_id_6, busyness, data_type)
                        VALUES(%s, {0}, '{1}')
                        ON DUPLICATE KEY UPDATE
                        busyness = {0},
                        data_type = '{1}'""".format(data['busyness'], str(data['type']))
        cursor.execute(query_string, (restaurant_id,))

    
    


def getBusyness(formatted_info):
    restaurant_info = lpt.get_populartimes_by_formatted_address(formatted_info[0])
    if restaurant_info is None:
        return None
    else:
        busyness = restaurant_info['current_popularity']
        if busyness is not None:
            data = {
                "type": "L",
                "busyness": busyness
            }
        else:
            if restaurant_info['popular_times'] is None:
                return None
            # localtime_info = strftime("%w %H", time.localtime()).split()
            convertedtime_info = convertToLocalTime(datetime.datetime.today(), formatted_info[1])
            time_info = convertedtime_info.strftime("%w %H").split()
            hour = int(time_info[1])
            day_of_the_week = int(time_info[0]) - 1
            if day_of_the_week == -1:
                day_of_the_week = 0
            busyness = restaurant_info['populartimes'][day_of_the_week]['data'][hour]
            # print("-----" + str(hour) + " " + str(day_of_the_week) + "-----")p
            data = {
                "type": "H",
                "busyness": busyness
            }

    return data


def convertToLocalTime(localtime, timezone):
    if timezone == "ET":
        return localtime.astimezone(pytz.timezone('America/Toronto'))
    elif timezone == "CT":
        return localtime.astimezone(pytz.timezone('America/Winnipeg'))
    elif timezone == "AT":
        return localtime.astimezone(pytz.timezone('America/Halifax'))

    # print("PT found")

    return localtime


def loadAllBusyness(cnx):
    cursor = cnx.cursor(buffered=True)

    query_string = """SELECT Locations.restaurant_id_3, Main.name, Locations.address 
                FROM Locations 
                INNER JOIN Main ON Locations.restaurant_id_3 = Main.restaurant_id"""

    # information = []
    cursor = cnx.cursor(buffered=True)     
    cursor.execute(query_string)
    for (restaurant_id_3, name, address) in cursor:
        # print(restaurant_id_3)
        formatted_info = formatAddress(restaurant_id_3[0:3], name, address)
        # print(formatted_address)
        busyness = getBusyness(formatted_info)
        # print(busyness)
        storeBusyness(restaurant_id_3, busyness, cnx)
        # information.append(restaurant_id_3)
        cnx.commit()


def formatAddress(id, name, address):
    city_code = id[0:3]
    city = city_dict.get(city_code)["city"]
    timezone = city_dict.get(city_code)["timezone"]
    name = name.strip(' ')
    address = address.strip(' ')
    address = address.strip('.')
    address = address.strip(',')

    formatted_address = "({0}) {1}, {2}".format(name, address, city)
    # print(formatted_address)
    return [formatted_address, timezone]
    
# def application(environ, start_response):
#     start_response('200 OK', [('Content-Type', 'text/plain')])
#     try:
#         connection = mysql.connector.connect(
#             user="catherine",
#             password="@AxzGH1Y77!",
#             host="localhost",
#             database="vancouver_togo"
#         )
    
#         rest_ids = loadAllBusyness(connection)
#         connection.commit()
#     except mysql.connector.Error as err:
#             # print(err)
#         print(err);
#     else:
#         connection.close()

#     # message = 'It works!\n'
#     # version = 'Python %s\n' % sys.version.split()[0]
#     # response = '\n'.join([message, rest_ids])
    
#     # return [response.encode()]

if __name__ == "__main__":
    try:
        connection = mysql.connector.connect(
            user="catherine",
            password="@AxzGH1Y77!",
            host="localhost",
            database="vancouver_togo"
        )
                    
        loadAllBusyness(connection)
        # connection.commit()
        # getBusyness("(H-Mart) 5557 Dunbar Street, Vancouver BC, Canada")
        # f = open(out.txt, 'w')
        # print('it worked', file=f)
    except mysql.connector.Error as err:
        print(err)
    else:
        connection.close()