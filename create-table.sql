create table [dbo].[Registration](
    id INT NOT NULL IDENTITY(1,1) PRIMARY KEY(id),
    name VARCHAR(50),
    email VARCHAR(50),
    job VARCHAR(50),
    date DATE
);
